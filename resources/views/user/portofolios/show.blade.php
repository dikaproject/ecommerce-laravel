@extends('layouts.app')

@section('title', $portofolio->title . ' - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $portofolio->title }}</h1>
            <p class="text-xl max-w-3xl mx-auto">{{ $portofolio->service->name }}</p>
        </div>
    </section>

    <!-- Portfolio Details -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Image -->
                <div>
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ asset('storage/' . $portofolio->image_url) }}" alt="{{ $portofolio->title }}" class="w-full h-auto">
                    </div>
                </div>
                
                <!-- Details -->
                <div>
                    <div class="mb-6">
                        <span class="inline-block bg-indigo-100 text-indigo-600 text-sm font-medium px-3 py-1 rounded-full mb-4">{{ $portofolio->service->name }}</span>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $portofolio->title }}</h2>
                        <div class="prose max-w-none text-gray-600 mb-8">
                            {{ $portofolio->description }}
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-xl font-semibold mb-4">Layanan Terkait</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium">{{ $portofolio->service->name }}</h4>
                                <p class="text-gray-500 text-sm">Mulai dari</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-indigo-600 font-semibold">Rp {{ number_format($portofolio->service->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:space-x-4">
                        <a href="{{ route('user.orders.create', ['service_id' => $portofolio->service->id]) }}" class="bg-indigo-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-indigo-700 transition text-center mb-4 sm:mb-0">Pesan Serupa</a>
                        <a href="{{ route('services.show', $portofolio->service) }}" class="border border-indigo-600 text-indigo-600 py-3 px-8 rounded-lg font-medium hover:bg-indigo-50 transition text-center">Lihat Layanan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Portfolios -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Portofolio Terkait</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($relatedPortfolios as $portfolio)
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
                        <p class="text-gray-500">Tidak ada portofolio terkait yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 hero-gradient text-white">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Wujudkan Ide Kreatif Anda?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Jadikan brand Anda menonjol dengan desain berkualitas dari tim profesional kami</p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                <a href="{{ route('user.orders.create') }}" class="bg-white text-indigo-600 py-3 px-8 rounded-lg font-medium hover:bg-gray-100 transition">Pesan Sekarang</a>
            </div>
        </div>
    </section>
@endsection