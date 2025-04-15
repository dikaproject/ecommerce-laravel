@extends('layouts.admin')

@section('title', 'Dashboard - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Pengguna</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>
        
        <!-- Total Services Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Layanan</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['total_services'] }}</p>
                </div>
            </div>
        </div>
        
        <!-- Pending Orders Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pesanan Pending</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['pending_orders'] }}</p>
                </div>
            </div>
        </div>
        
        <!-- Total Revenue Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Pendapatan</p>
                    <p class="text-2xl font-semibold text-gray-800">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Pesanan Terbaru</h2>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="py-3 px-4 text-gray-600">Order ID</th>
                        <th class="py-3 px-4 text-gray-600">Pengguna</th>
                        <th class="py-3 px-4 text-gray-600">Layanan</th>
                        <th class="py-3 px-4 text-gray-600">Tanggal</th>
                        <th class="py-3 px-4 text-gray-600">Total</th>
                        <th class="py-3 px-4 text-gray-600">Status</th>
                        <th class="py-3 px-4 text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recent_orders as $order)
                        <tr>
                            <td class="py-3 px-4">
                                #{{ $order->id }}
                            </td>
                            <td class="py-3 px-4">
                                {{ $order->user->name }}
                            </td>
                            <td class="py-3 px-4">
                                {{ $order->service->name }}
                            </td>
                            <td class="py-3 px-4">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="py-3 px-4">
                                Rp {{ number_format($order->total_price_after_discount, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4">
                                @if($order->status == 'Pending')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Pending</span>
                                @elseif($order->status == 'Paid')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Dibayar</span>
                                @elseif($order->status == 'Completed')
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Selesai</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection