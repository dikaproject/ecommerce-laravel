@extends('layouts.app')

@section('title', 'DesignArt Studio - Jasa Desain Profesional')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Solusi Desain Kreatif untuk Bisnis Anda</h1>
                    <p class="text-xl mb-8">Tingkatkan brand Anda dengan layanan desain profesional dari DesignArt Studio</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('services.index') }}" class="bg-white text-indigo-600 py-3 px-8 rounded-lg font-medium hover:bg-gray-100 transition text-center">Lihat Layanan</a>
                        <a href="{{ route('user.orders.create') }}" class="bg-indigo-800 text-white py-3 px-8 rounded-lg font-medium hover:bg-indigo-900 transition text-center">Pesan Sekarang</a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://via.placeholder.com/600x400" alt="Design Services" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai layanan desain untuk memenuhi kebutuhan bisnis Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($services as $service)
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-paint-brush text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">{{ $service->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($service->description, 100) }}</p>
                    <a href="{{ route('services.show', $service) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Pelajari Lebih Lanjut &rarr;</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Recent Works Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Portofolio Terbaru</h2>
                    <p class="text-gray-600">Beberapa proyek terbaru yang telah kami kerjakan</p>
                </div>
                <a href="{{ route('portfolios.index') }}" class="mt-4 md:mt-0 inline-block bg-indigo-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-indigo-700 transition">Lihat Semua Karya</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($portfolios as $portfolio)
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition group">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $portfolio->image_url) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $portfolio->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($portfolio->description, 100) }}</p>
                        <a href="{{ route('user.orders.create', ['service_id' => $portfolio->service_id]) }}" class="inline-block bg-indigo-600 text-white py-2 px-6 rounded-lg font-medium hover:bg-indigo-700 transition">Pesan Serupa</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 hero-gradient text-white">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Tingkatkan Kualitas Desain Anda?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Hubungi kami sekarang dan dapatkan konsultasi gratis untuk kebutuhan desain Anda</p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                <a href="{{ route('user.orders.create') }}" class="bg-indigo-800 text-white py-3 px-8 rounded-lg font-medium hover:bg-indigo-900 border border-white transition">Pesan Sekarang</a>
            </div>
        </div>
    </section>
@endsection