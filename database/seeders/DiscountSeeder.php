<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General discount for all services
        Discount::create([
            'code' => 'WELCOME25',
            'description' => 'Diskon 25% untuk pelanggan baru',
            'discount_type' => 'Percentage',
            'value' => 25,
            'max_discount' => 300000, // max 300k IDR
            'valid_from' => Carbon::now(),
            'valid_until' => Carbon::now()->addMonths(3),
            'service_id' => null, // applies to all services
        ]);
        
        // Fixed amount discount
        Discount::create([
            'code' => 'FLAT100K',
            'description' => 'Diskon potongan langsung Rp 100.000',
            'discount_type' => 'Fixed',
            'value' => 100000,
            'max_discount' => null,
            'valid_from' => Carbon::now(),
            'valid_until' => Carbon::now()->addMonths(2),
            'service_id' => null, // applies to all services
        ]);
        
        // Service-specific discounts
        $logoService = Service::where('name', 'Desain Logo')->first();
        Discount::create([
            'code' => 'LOGO20',
            'description' => 'Diskon 20% khusus untuk jasa desain logo',
            'discount_type' => 'Percentage',
            'value' => 20,
            'max_discount' => null,
            'valid_from' => Carbon::now(),
            'valid_until' => Carbon::now()->addMonths(1),
            'service_id' => $logoService->id,
        ]);
        
        $websiteService = Service::where('name', 'Desain Website UI/UX')->first();
        Discount::create([
            'code' => 'WEBPROMO',
            'description' => 'Diskon khusus untuk jasa desain website',
            'discount_type' => 'Fixed',
            'value' => 200000,
            'max_discount' => null,
            'valid_from' => Carbon::now(),
            'valid_until' => Carbon::now()->addMonths(1),
            'service_id' => $websiteService->id,
        ]);
    }
}