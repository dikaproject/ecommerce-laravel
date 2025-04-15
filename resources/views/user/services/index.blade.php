@extends('layouts.app')

@section('title', 'Layanan - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Kami</h1>
            <p class="text-xl max-w-3xl mx-auto">Kami menawarkan berbagai layanan desain profesional untuk memenuhi kebutuhan bisnis Anda</p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            @foreach($services as $index => $service)
                <div id="{{ strtolower(str_replace(' ', '-', $service->name)) }}" class="flex flex-col {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center mb-20 scroll-mt-32">
                    <div class="md:w-1/2 mb-8 md:mb-0 {{ $index % 2 == 0 ? 'md:pr-8' : 'md:pl-8' }}">
                        <div class="bg-indigo-100 w-20 h-20 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-paint-brush text-3xl text-indigo-600"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $service->name }}</h2>
                        <p class="text-gray-600 mb-6">{{ $service->description }}</p>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700 font-medium">Harga</span>
                                <span class="text-indigo-600 font-semibold">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <a href="{{ route('user.orders.create', ['service_id' => $service->id]) }}" class="bg-indigo-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-indigo-700 transition inline-block">Pesan Sekarang</a>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        @if($service->portofolios->isNotEmpty())
                            <img src="{{ asset('storage/' . $service->portofolios->first()->image_url) }}" alt="{{ $service->name }}" class="rounded-lg shadow-xl w-full">
                        @else
                            <img src="https://via.placeholder.com/600x400" alt="{{ $service->name }}" class="rounded-lg shadow-xl w-full">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Proses Kerja Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Pengalaman bekerja dengan kami yang mudah dan transparan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="bg-white rounded-lg p-6 shadow-md relative">
                    <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto text-white font-bold">1</div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Konsultasi</h3>
                    <p class="text-gray-600 text-center">Diskusikan kebutuhan dan tujuan Anda bersama tim kami secara detail.</p>
                    <div class="hidden md:block absolute top-12 right-0 transform translate-x-1/2">
                        <i class="fas fa-long-arrow-alt-right text-3xl text-indigo-400"></i>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-white rounded-lg p-6 shadow-md relative">
                    <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto text-white font-bold">2</div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Persetujuan Konsep</h3>
                    <p class="text-gray-600 text-center">Kami akan memberikan konsep awal untuk disetujui sebelum melanjutkan.</p>
                    <div class="hidden md:block absolute top-12 right-0 transform translate-x-1/2">
                        <i class="fas fa-long-arrow-alt-right text-3xl text-indigo-400"></i>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-white rounded-lg p-6 shadow-md relative">
                    <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto text-white font-bold">3</div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Pengerjaan</h3>
                    <p class="text-gray-600 text-center">Tim kami akan mengerjakan proyek dengan detail dan sesuai timeline.</p>
                    <div class="hidden md:block absolute top-12 right-0 transform translate-x-1/2">
                        <i class="fas fa-long-arrow-alt-right text-3xl text-indigo-400"></i>
                    </div>
                </div>
                
                <!-- Step 4 -->
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto text-white font-bold">4</div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Hasil & Revisi</h3>
                    <p class="text-gray-600 text-center">Anda akan menerima hasil akhir dengan kesempatan revisi sesuai paket.</p>
                </div>
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