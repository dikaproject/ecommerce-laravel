@extends('layouts.app')

@section('title', 'Portofolio - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Portofolio Kami</h1>
            <p class="text-xl max-w-3xl mx-auto">Lihat hasil karya terbaik kami dalam berbagai proyek desain</p>
        </div>
    </section>

    <!-- Portfolio Filters -->
    <section class="py-10 bg-white border-b">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-wrap justify-center space-x-2 space-y-2 md:space-y-0">
                <a href="{{ route('portfolios.index') }}" class="filter-btn {{ !request('service_id') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-indigo-600 hover:text-white' }} py-2 px-6 rounded-full font-medium transition">
                    Semua
                </a>
                
                @foreach($services as $service)
                    <a href="{{ route('portfolios.by-service', $service) }}" class="filter-btn {{ request()->route('service') && request()->route('service')->id == $service->id ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-indigo-600 hover:text-white' }} py-2 px-6 rounded-full font-medium transition">
                        {{ $service->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
                @forelse($portofolios as $portfolio)
                    <div class="portfolio-item bg-gray-50 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition relative group">
                        <div class="h-64 overflow-hidden">
                            <img src="{{ asset('storage/' . $portfolio->image_url) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-xl font-semibold">{{ $portfolio->title }}</h3>
                                <span class="bg-indigo-100 text-indigo-600 text-xs font-medium px-3 py-1 rounded-full">{{ $portfolio->service->name }}</span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($portfolio->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('portfolios.show', $portfolio) }}" class="inline-block text-indigo-600 hover:text-indigo-800">Lihat Detail</a>
                                <a href="{{ route('user.orders.create', ['service_id' => $portfolio->service->id]) }}" class="inline-block bg-indigo-600 text-white py-2 px-6 rounded-lg font-medium hover:bg-indigo-700 transition">Pesan Serupa</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Belum ada portofolio yang tersedia.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12">
                {{ $portofolios->links() }}
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