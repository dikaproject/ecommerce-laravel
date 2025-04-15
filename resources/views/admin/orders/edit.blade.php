@extends('layouts.admin')

@section('title', 'Edit Status Pesanan - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Update Status Pesanan #{{ $order->id }}</h1>
        <p class="text-gray-600">Perbarui status pesanan</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="status" class="block text-gray-700 font-medium mb-2">Status Pesanan</label>
                        <select name="status" id="status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500" required>
                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Paid" {{ $order->status == 'Paid' ? 'selected' : '' }}>Dibayar</option>
                            <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    
                    <div class="flex items-center justify-end">
                        <a href="{{ route('admin.orders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg mr-2">
                            Kembali
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Detail Pesanan</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Pelanggan</p>
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
                    <div>
                        <p class="text-sm text-gray-500">Layanan</p>
                        <p>{{ $order->service->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Metode Pengiriman</p>
                        <p>{{ $order->delivery_method }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Metode Pembayaran</p>
                        <p>{{ $order->payment_method }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total</p>
                        <p class="font-semibold">Rp {{ number_format($order->total_price_after_discount, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Order</p>
                        <p>{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection