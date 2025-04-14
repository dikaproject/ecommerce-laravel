<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'service_id',
    ];
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}