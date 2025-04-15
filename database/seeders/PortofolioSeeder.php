<?php

namespace Database\Seeders;

use App\Models\Portofolio;
use App\Models\Service;
use Illuminate\Database\Seeder;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Placeholder images - in a real scenario, you would upload actual portfolio images
        $placeholderImages = [
            'portofolios/logo1.jpg',
            'portofolios/logo2.jpg',
            'portofolios/banner1.jpg',
            'portofolios/banner2.jpg',
            'portofolios/powerpoint1.jpg',
            'portofolios/powerpoint2.jpg',
            'portofolios/website1.jpg',
            'portofolios/website2.jpg',
            'portofolios/video1.jpg',
            'portofolios/video2.jpg',
        ];
        
        // Create sample portfolio items for each service
        $services = Service::all();
        
        // Logo Design Portfolios
        Portofolio::create([
            'title' => 'Logo Green Healthy Food',
            'description' => 'Logo untuk brand makanan sehat dengan konsep minimalis dan modern.',
            'image_url' => $placeholderImages[0],
            'service_id' => $services->where('name', 'Desain Logo')->first()->id,
        ]);
        
        Portofolio::create([
            'title' => 'Logo Tech Startup Innovate',
            'description' => 'Desain logo untuk startup teknologi dengan konsep futuristik dan dinamis.',
            'image_url' => $placeholderImages[1],
            'service_id' => $services->where('name', 'Desain Logo')->first()->id,
        ]);
        
        // Banner & Poster Portfolios
        Portofolio::create([
            'title' => 'Banner Promo Summer Sale',
            'description' => 'Banner promosi untuk kampanye summer sale dengan warna-warna vibrant.',
            'image_url' => $placeholderImages[2],
            'service_id' => $services->where('name', 'Desain Banner & Poster')->first()->id,
        ]);
        
        Portofolio::create([
            'title' => 'Poster Event Musik Festival',
            'description' => 'Poster untuk festival musik tahunan dengan tema retro dan psychedelic.',
            'image_url' => $placeholderImages[3],
            'service_id' => $services->where('name', 'Desain Banner & Poster')->first()->id,
        ]);
        
        // PowerPoint Portfolios
        Portofolio::create([
            'title' => 'Presentasi Bisnis Plan',
            'description' => 'Slide deck untuk presentasi bisnis plan dengan visualisasi data menarik.',
            'image_url' => $placeholderImages[4],
            'service_id' => $services->where('name', 'Desain Presentasi PowerPoint')->first()->id,
        ]);
        
        Portofolio::create([
            'title' => 'PowerPoint Company Profile',
            'description' => 'Desain presentasi untuk company profile dengan gaya elegan dan profesional.',
            'image_url' => $placeholderImages[5],
            'service_id' => $services->where('name', 'Desain Presentasi PowerPoint')->first()->id,
        ]);
        
        // Website UI/UX Portfolios
        Portofolio::create([
            'title' => 'UI Design E-commerce Fashion',
            'description' => 'Desain antarmuka untuk website e-commerce fashion dengan pendekatan minimalis.',
            'image_url' => $placeholderImages[6],
            'service_id' => $services->where('name', 'Desain Website UI/UX')->first()->id,
        ]);
        
        Portofolio::create([
            'title' => 'Website Travel Agency',
            'description' => 'UI/UX design untuk website agen travel dengan fokus pada visual experience.',
            'image_url' => $placeholderImages[7],
            'service_id' => $services->where('name', 'Desain Website UI/UX')->first()->id,
        ]);
        
        // Video Marketing Portfolios
        Portofolio::create([
            'title' => 'Video Promosi Produk Skincare',
            'description' => 'Video marketing untuk brand skincare dengan konsep clean dan natural.',
            'image_url' => $placeholderImages[8],
            'service_id' => $services->where('name', 'Video Marketing')->first()->id,
        ]);
        
        Portofolio::create([
            'title' => 'Video Motion Graphic Explainer',
            'description' => 'Motion graphic video untuk menjelaskan layanan fintech dengan animasi 2D.',
            'image_url' => $placeholderImages[9],
            'service_id' => $services->where('name', 'Video Marketing')->first()->id,
        ]);
    }
}