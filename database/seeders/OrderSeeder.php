<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get data needed for creating orders
        $users = User::where('role', 'user')->get();
        $services = Service::all();
        $discounts = Discount::all();
        
        // Sample reference files (these would be actual uploaded files in production)
        $referenceFiles = [
            'references/ref1.pdf',
            'references/ref2.jpg',
            null,
            'references/ref4.png',
            null,
        ];
        
        // Sample order descriptions
        $descriptions = [
            'Saya membutuhkan logo untuk bisnis kafe yang baru dibuka. Tema yang diinginkan adalah modern minimalist dengan warna hijau dan coklat.',
            'Tolong buatkan banner untuk promo produk baru kami. Warna dominan biru dan putih, dengan tone yang profesional.',
            'Butuh presentasi untuk pitch bisnis startup, sekitar 15 slide dengan visualisasi data yang menarik.',
            'Saya ingin redesign website e-commerce saya dengan tampilan yang lebih modern dan user-friendly.',
            'Butuh video promosi singkat 30 detik untuk produk skincare. Tone yang diinginkan adalah bright dan natural.',
        ];
        
        // Create sample orders with different statuses
        $statuses = ['Pending', 'Paid', 'Completed'];
        $deliveryMethods = ['Email', 'WhatsApp'];
        $paymentMethods = ['QRIS', 'Transfer Bank'];
        
        // Create 10 sample orders
        for ($i = 0; $i < 10; $i++) {
            $user = $users->random();
            $service = $services->random();
            $useDiscount = rand(0, 1); // 50% chance to have discount
            
            $discount = null;
            $discountAmount = 0;
            $totalPrice = $service->price;
            $totalAfterDiscount = $totalPrice;
            
            if ($useDiscount) {
                // Get valid discount for this service
                $discount = $discounts->where(function ($item) use ($service) {
                    return $item->service_id === null || $item->service_id === $service->id;
                })->random();
                
                // Calculate discount
                if ($discount->discount_type === 'Percentage') {
                    $discountAmount = $service->price * ($discount->value / 100);
                    if ($discount->max_discount !== null && $discountAmount > $discount->max_discount) {
                        $discountAmount = $discount->max_discount;
                    }
                } else {
                    $discountAmount = $discount->value;
                }
                
                $totalAfterDiscount = $totalPrice - $discountAmount;
            }
            
            // Create order with randomized data
            Order::create([
                'user_id' => $user->id,
                'service_id' => $service->id,
                'description' => $descriptions[array_rand($descriptions)],
                'reference_file' => $referenceFiles[array_rand($referenceFiles)],
                'delivery_method' => $deliveryMethods[array_rand($deliveryMethods)],
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'status' => $statuses[array_rand($statuses)],
                'discount_id' => $discount ? $discount->id : null,
                'discount_amount' => $discountAmount,
                'total_price' => $totalPrice,
                'total_price_after_discount' => $totalAfterDiscount,
                // Randomize created_at within the last 30 days
                'created_at' => Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }
    }
}