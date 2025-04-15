@extends('layouts.admin')

@section('title', 'Pesanan - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Pesanan</h1>
    </div>
    
    <div class="mb-6">
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded-full {{ !request('status') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                Semua
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'Pending']) }}" class="px-4 py-2 rounded-full {{ request('status') == 'Pending' ? 'bg-yellow-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                Pending
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'Paid']) }}" class="px-4 py-2 rounded-full {{ request('status') == 'Paid' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                Dibayar
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'Completed']) }}" class="px-4 py-2 rounded-full {{ request('status') == 'Completed' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                Selesai
            </a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="py-3 px-4 text-gray-600">Order ID</th>
                    <th class="py-3 px-4 text-gray-600">Pelanggan</th>
                    <th class="py-3 px-4 text-gray-600">Layanan</th>
                    <th class="py-3 px-4 text-gray-600">Tanggal</th>
                    <th class="py-3 px-4 text-gray-600">Total</th>
                    <th class="py-3 px-4 text-gray-600">Status</th>
                    <th class="py-3 px-4 text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr>
                    <td class="py-3 px-4">#{{ $order->id }}</td>
                    <td class="py-3 px-4">{{ $order->user->name }}</td>
                    <td class="py-3 px-4">{{ $order->service->name }}</td>
                    <td class="py-3 px-4">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="py-3 px-4">Rp {{ number_format($order->total_price_after_discount, 0, ',', '.') }}</td>
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
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-3 px-4 text-center text-gray-500">Tidak ada data pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection