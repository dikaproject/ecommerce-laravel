@extends('layouts.app')

@section('title', $service->name . ' - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $service->name }}</h1>
            <p class="text-xl max-w-3xl mx-auto">{{ $service->description }}</p>
        </div>
    </section>

    <!-- Service Details -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Service Info -->
                <div class="lg:w-2/3">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Detail Layanan</h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-600 mb-6">{{ $service->description }}</p>
                        
                        <div class="flex flex-col sm:flex-row justify-between items-center bg-gray-50 p-6 rounded-lg mt-8">
                            <div>
                                <span class="text-gray-500">Harga:</span>
                                <span class="text-2xl font-bold text-indigo-600 ml-2">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('user.orders.create', ['service_id' => $service->id]) }}" class="mt-4 sm:mt-0 bg-indigo-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-indigo-700 transition">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="lg:w-1/3 bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Mengapa Memilih Layanan Kami?</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Tim desainer profesional berpengalaman</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Unlimited revisi sesuai paket</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Pengerjaan cepat dan tepat waktu</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">File source lengkap</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Support 24/7</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Portofolio {{ $service->name }}</h2>
                    <p class="text-gray-600">Beberapa contoh hasil karya kami untuk layanan ini</p>
                </div>
                <a href="{{ route('portfolios.by-service', $service) }}" class="mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 font-medium">Lihat Semua &rarr;</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($service->portofolios->take(3) as $portfolio)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition group">
                        <div class="h-64 overflow-hidden">
                            <img src="{{ asset('storage/' . $portfolio->image_url) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $portfolio->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($portfolio->description, 100) }}</p>
                            <a href="{{ route('portfolios.show', $portfolio) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Belum ada portofolio untuk layanan ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 hero-gradient text-white">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap untuk Tingkatkan Brand Anda?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Pesan layanan {{ $service->name }} sekarang dan tingkatkan kualitas desain Anda</p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                <a href="{{ route('user.orders.create', ['service_id' => $service->id]) }}" class="bg-white text-indigo-600 py-3 px-8 rounded-lg font-medium hover:bg-gray-100 transition">Pesan Sekarang</a>
            </div>
        </div>
    </section>
@endsection