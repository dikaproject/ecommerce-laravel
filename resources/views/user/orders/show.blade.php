@extends('layouts.app')

@section('title', 'Detail Pesanan - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Detail Pesanan</h1>
            <p class="text-xl max-w-3xl mx-auto">Informasi lengkap tentang pesanan Anda</p>
        </div>
    </section>

    <!-- Order Details Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Order Status -->
                <div class="p-6 bg-gray-50 border-b">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
                            <p class="text-gray-600">{{ $order->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            @if($order->status == 'Pending')
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded">Menunggu Pembayaran</span>
                            @elseif($order->status == 'Paid')
                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded">Diproses</span>
                            @elseif($order->status == 'Completed')
                                <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded">Selesai</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Order Details -->
                <div class="p-6 border-b">
                    <h3 class="font-semibold text-gray-800 mb-4">Detail Layanan</h3>
                    <div class="flex items-start">
                        <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center mr-4">
                            <i class="fas fa-paint-brush text-gray-400 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $order->service->name }}</h4>
                            <p class="text-gray-600 text-sm mt-1">Rp {{ number_format($order->service->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Project Description -->
                <div class="p-6 border-b">
                    <h3 class="font-semibold text-gray-800 mb-4">Deskripsi Proyek</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700">{{ $order->description }}</p>
                    </div>
                </div>
                
                @if($order->reference_file)
                <!-- Reference File -->
                <div class="p-6 border-b">
                    <h3 class="font-semibold text-gray-800 mb-4">File Referensi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg flex items-center">
                        <i class="fas fa-file-alt text-gray-500 mr-3"></i>
                        <span class="text-gray-700 truncate flex-1">{{ basename($order->reference_file) }}</span>
                        <a href="{{ Storage::url($order->reference_file) }}" download class="text-indigo-600 hover:text-indigo-800">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
                @endif
                
                <!-- Order Information -->
                <div class="p-6 border-b">
                    <h3 class="font-semibold text-gray-800 mb-4">Informasi Pesanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 text-sm mb-1">Metode Pengiriman</p>
                            <p class="font-semibold">{{ $order->delivery_method }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm mb-1">Metode Pembayaran</p>
                            <p class="font-semibold">{{ $order->payment_method }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Details -->
                <div class="p-6 bg-gray-50">
                    <h3 class="font-semibold text-gray-800 mb-4">Detail Pembayaran</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga Layanan:</span>
                            <span class="text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Diskon:</span>
                            <span class="text-green-600">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between font-semibold border-t border-gray-200 pt-2 mt-2">
                            <span>Total:</span>
                            <span>Rp {{ number_format($order->total_price_after_discount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="p-6 flex justify-between">
                    <a href="{{ route('user.orders.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    
                    @if($order->status == 'Pending')
                    <a href="{{ route('user.orders.payment', $order) }}" class="bg-indigo-600 text-white py-2 px-6 rounded-lg font-medium hover:bg-indigo-700 transition">
                        Lanjutkan Pembayaran
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection