<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
    ];
    
    public function portofolios()
    {
        return $this->hasMany(Portofolio::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}