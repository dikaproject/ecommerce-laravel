<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'value',
        'max_discount',
        'valid_from',
        'valid_until',
        'service_id',
    ];
    
    protected $casts = [
        'value' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function isValid()
    {
        $now = now();
        return $now->gte($this->valid_from) && $now->lte($this->valid_until);
    }
    
    public function calculateDiscountAmount($price)
    {
        if ($this->discount_type === 'Percentage') {
            $amount = $price * ($this->value / 100);
            return $this->max_discount ? min($amount, $this->max_discount) : $amount;
        }
        
        return $this->value; // Fixed amount
    }
}