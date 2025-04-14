<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'service', 'discount'])
            ->latest()
            ->paginate(10);
            
        return view('admin.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        $order->load(['user', 'service', 'discount']);
        return view('admin.orders.show', compact('order'));
    }
    
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }
    
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Paid,Completed',
        ]);
        
        $order->update($validated);
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status updated successfully.');
    }
    
    public function destroy(Order $order)
    {
        // Delete reference file if exists
        if ($order->reference_file) {
            Storage::disk('public')->delete($order->reference_file);
        }
        
        $order->delete();
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}