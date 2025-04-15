@extends('layouts.app')

@section('title', 'Pesanan Saya - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Pesanan Saya</h1>
            <p class="text-xl max-w-3xl mx-auto">Kelola dan pantau status pesanan Anda</p>
        </div>
    </section>

    <!-- Orders Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            @if(session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="p-6 bg-gray-50 border-b flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Pesanan</h2>
                    <a href="{{ route('user.orders.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Pesan Baru
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    @if($orders->isEmpty())
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                                <i class="fas fa-shopping-bag text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada pesanan</h3>
                            <p class="text-gray-600 mb-4">Anda belum memiliki pesanan. Mulai pesan layanan desain sekarang.</p>
                            <a href="{{ route('services.index') }}" class="bg-indigo-600 text-white py-2 px-6 rounded-lg font-medium hover:bg-indigo-700 transition">
                                Lihat Layanan
                            </a>
                        </div>
                    @else
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50 text-left">
                                    <th class="py-3 px-6 text-gray-600">Order ID</th>
                                    <th class="py-3 px-6 text-gray-600">Layanan</th>
                                    <th class="py-3 px-6 text-gray-600">Tanggal</th>
                                    <th class="py-3 px-6 text-gray-600">Total</th>
                                    <th class="py-3 px-6 text-gray-600">Status</th>
                                    <th class="py-3 px-6 text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="py-4 px-6">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $order->service->name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>
                                        <td class="py-4 px-6">
                                            Rp {{ number_format($order->total_price_after_discount, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($order->status == 'Pending')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Menunggu Pembayaran</span>
                                            @elseif($order->status == 'Paid')
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Diproses</span>
                                            @elseif($order->status == 'Completed')
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('user.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    Detail
                                                </a>
                                                @if($order->status == 'Pending')
                                                    <a href="{{ route('user.orders.payment', $order) }}" class="text-green-600 hover:text-green-900">
                                                        Bayar
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            
            {{ $orders->links() }}
        </div>
    </section>
@endsection