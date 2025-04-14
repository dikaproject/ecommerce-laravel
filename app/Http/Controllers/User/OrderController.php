<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Service;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    protected $midtransService;
    
    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Display a listing of the user's orders
     */
    public function index()
    {
        $orders = Auth::user()->orders()
            ->with('service')
            ->latest()
            ->paginate(10);
            
        return view('user.orders.index', compact('orders'));
    }
    
    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        // Check if order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $order->load(['service', 'discount']);
        return view('user.orders.show', compact('order'));
    }
    
    /**
     * Show the form for creating a new order
     */
    public function create(Request $request)
    {
        $service = null;
        $services = Service::all();
        
        if ($request->has('service_id')) {
            $service = Service::findOrFail($request->service_id);
        }
        
        return view('user.orders.create', compact('service', 'services'));
    }
    
    /**
     * Store a newly created order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'description' => 'required|string',
            'reference_file' => 'nullable|file|max:10240', // 10MB max
            'delivery_method' => 'required|in:Email,WhatsApp',
            'payment_method' => 'required|in:QRIS,Transfer Bank',
            'discount_code' => 'nullable|string|exists:discounts,code',
        ]);
        
        $service = Service::findOrFail($validated['service_id']);
        $totalPrice = $service->price;
        $discountAmount = 0;
        $discountId = null;
        
        // Process discount if provided
        if (!empty($validated['discount_code'])) {
            $discount = Discount::where('code', $validated['discount_code'])
                ->where(function($query) use ($service) {
                    $query->whereNull('service_id')
                        ->orWhere('service_id', $service->id);
                })
                ->first();
                
            if ($discount && $discount->isValid()) {
                $discountAmount = $discount->calculateDiscountAmount($totalPrice);
                $discountId = $discount->id;
            }
        }
        
        $totalAfterDiscount = $totalPrice - $discountAmount;
        
        // Store reference file if provided
        $referenceFilePath = null;
        if ($request->hasFile('reference_file')) {
            $referenceFilePath = $request->file('reference_file')->store('references', 'public');
        }
        
        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'service_id' => $service->id,
            'description' => $validated['description'],
            'reference_file' => $referenceFilePath,
            'delivery_method' => $validated['delivery_method'],
            'payment_method' => $validated['payment_method'],
            'status' => 'Pending',
            'discount_id' => $discountId,
            'discount_amount' => $discountAmount,
            'total_price' => $totalPrice,
            'total_price_after_discount' => $totalAfterDiscount,
        ]);
        
        return redirect()->route('user.orders.payment', $order)
            ->with('success', 'Order created successfully. Please complete your payment.');
    }
    
    /**
     * Show payment page for the order with Midtrans integration
     */
    public function payment(Order $order)
    {
        // Check if order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if order is still pending
        if ($order->status !== 'Pending') {
            return redirect()->route('user.orders.show', $order)
                ->with('info', 'This order has already been processed.');
        }
        
        // Generate Midtrans snap token
        $snapToken = $this->midtransService->createTransaction($order);
        
        if (!$snapToken) {
            return redirect()->route('user.orders.index')
                ->with('error', 'Failed to create payment. Please try again later.');
        }
        
        return view('user.orders.payment', compact('order', 'snapToken'));
    }
    
    /**
     * Handle Midtrans payment notification callback
     */
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            // Extract order ID from the order_id field (format: ORDER-{id})
            $orderId = str_replace('ORDER-', '', $request->order_id);
            $order = Order::find($orderId);
            
            if (!$order) {
                Log::error('Order not found in callback', ['order_id' => $orderId]);
                return response()->json(['success' => false, 'message' => 'Order not found'], 404);
            }
            
            Log::info('Midtrans callback received', [
                'order_id' => $orderId,
                'status' => $request->transaction_status
            ]);
            
            // Update order status based on transaction status
            if (in_array($request->transaction_status, ['capture', 'settlement'])) {
                $order->update(['status' => 'Paid']);
                Log::info('Order marked as paid', ['order_id' => $order->id]);
            } elseif (in_array($request->transaction_status, ['deny', 'expire', 'cancel'])) {
                // You could set a different status or leave as pending
                Log::info('Payment failed or cancelled', [
                    'order_id' => $order->id,
                    'status' => $request->transaction_status
                ]);
            }
            
            return response()->json(['success' => true]);
        }
        
        Log::warning('Invalid signature in Midtrans callback', [
            'order_id' => $request->order_id
        ]);
        
        return response()->json(['success' => false, 'message' => 'Invalid signature'], 400);
    }
    
    /**
     * Validate discount code via AJAX
     */
    public function validateDiscount(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:discounts,code',
            'service_id' => 'required|exists:services,id',
        ]);
        
        $service = Service::findOrFail($request->service_id);
        $discount = Discount::where('code', $request->code)
            ->where(function($query) use ($service) {
                $query->whereNull('service_id')
                    ->orWhere('service_id', $service->id);
            })
            ->first();
            
        if (!$discount || !$discount->isValid()) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid or expired discount code.',
            ]);
        }
        
        $discountAmount = $discount->calculateDiscountAmount($service->price);
        $totalAfterDiscount = $service->price - $discountAmount;
        
        return response()->json([
            'valid' => true,
            'discount_type' => $discount->discount_type,
            'discount_value' => $discount->value,
            'discount_amount' => $discountAmount,
            'original_price' => $service->price,
            'total_after_discount' => $totalAfterDiscount,
            'message' => 'Discount applied successfully!',
        ]);
    }
    
    /**
     * Handle payment completion from Midtrans redirect
     */
    public function paymentFinish(Request $request)
    {
        // This method handles the redirect back from Midtrans payment page
        $status = $request->query('status', 'unknown');
        $message = '';
        
        switch($status) {
            case 'success':
                $message = 'Payment completed successfully! We will process your order shortly.';
                break;
            case 'pending':
                $message = 'Your payment is being processed. We will notify you once completed.';
                break;
            case 'error':
                $message = 'There was an issue with your payment. Please try again or contact support.';
                break;
            default:
                $message = 'Thank you for your order.';
        }
        
        return redirect()->route('user.orders.index')->with('status', $message);
    }
}