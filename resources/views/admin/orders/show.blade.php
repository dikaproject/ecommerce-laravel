@extends('layouts.admin')

@section('title', 'Detail Pesanan - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
        <div>
            <a href="{{ route('admin.orders.edit', $order) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                <i class="fas fa-edit mr-2"></i> Edit Status
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pesanan</h2>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p>
                            @if($order->status == 'Pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Pending</span>
                            @elseif($order->status == 'Paid')
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Dibayar</span>
                            @elseif($order->status == 'Completed')
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Selesai</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Order</p>
                        <p>{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Layanan</p>
                        <p>{{ $order->service->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Harga Layanan</p>
                        <p>Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Diskon</p>
                        <p>{{ $order->discount ? $order->discount->code : 'Tidak ada' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Diskon</p>
                        <p>{{ $order->discount_amount > 0 ? 'Rp ' . number_format($order->discount_amount, 0, ',', '.') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Pembayaran</p>
                        <p class="font-semibold">Rp {{ number_format($order->total_price_after_discount, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Metode Pembayaran</p>
                        <p>{{ $order->payment_method }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Metode Pengiriman</p>
                        <p>{{ $order->delivery_method }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Order Description -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Deskripsi Pesanan</h2>
                <div class="bg-gray-50 p-4 rounded">
                    <p>{{ $order->description }}</p>
                </div>
                
                @if($order->reference_file)
                <div class="mt-4">
                    <h3 class="font-semibold mb-2">File Referensi</h3>
                    <a href="{{ asset('storage/' . $order->reference_file) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                        <i class="fas fa-file-download mr-2"></i> 
                        <span>Download File Referensi</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
        
        <div>
            <!-- Customer Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pelanggan</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p>{{ $order->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p>{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Telepon</p>
                        <p>{{ $order->user->phone ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection