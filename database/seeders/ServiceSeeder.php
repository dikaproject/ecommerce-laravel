<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Desain Logo',
                'description' => 'Jasa pembuatan logo profesional untuk brand, perusahaan, atau produk Anda. Termasuk konsep, sketsa, dan file dalam format vector.',
                'price' => 750000,
            ],
            [
                'name' => 'Desain Banner & Poster',
                'description' => 'Layanan desain banner, poster, dan media promosi visual dengan konsep kreatif dan eye-catching.',
                'price' => 500000,
            ],
            [
                'name' => 'Desain Presentasi PowerPoint',
                'description' => 'Pembuatan slide presentasi PowerPoint profesional dengan visualisasi data yang menarik dan template custom.',
                'price' => 650000,
            ],
            [
                'name' => 'Desain Website UI/UX',
                'description' => 'Layanan desain antarmuka website dengan fokus pada user experience dan estetika modern.',
                'price' => 1200000,
            ],
            [
                'name' => 'Video Marketing',
                'description' => 'Pembuatan video marketing/promosi dengan durasi 30-60 detik, termasuk storyboard dan editing.',
                'price' => 1500000,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }
}