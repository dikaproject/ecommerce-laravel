<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'service_id',
        'description',
        'reference_file',
        'delivery_method',
        'payment_method',
        'status',
        'discount_id',
        'discount_amount',
        'total_price',
        'total_price_after_discount',
    ];
    
    protected $casts = [
        'discount_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'total_price_after_discount' => 'decimal:2',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
    
    // Helper methods for order status
    public function isPending()
    {
        return $this->status === 'Pending';
    }
    
    public function isPaid()
    {
        return $this->status === 'Paid';
    }
    
    public function isCompleted()
    {
        return $this->status === 'Completed';
    }
}