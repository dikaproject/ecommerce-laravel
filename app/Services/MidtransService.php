<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.sanitize');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }
    
    public function createTransaction(Order $order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id,
                'gross_amount' => (int) $order->total_price_after_discount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone,
            ],
            'item_details' => [
                [
                    'id' => $order->service->id,
                    'price' => (int) $order->service->price,
                    'quantity' => 1,
                    'name' => $order->service->name,
                ]
            ],
        ];
        
        // Add discount if applicable
        if ($order->discount_amount > 0) {
            $params['item_details'][] = [
                'id' => 'discount',
                'price' => (int) -$order->discount_amount,
                'quantity' => 1,
                'name' => 'Discount' . ($order->discount ? ' (' . $order->discount->code . ')' : ''),
            ];
        }
        
        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }
}