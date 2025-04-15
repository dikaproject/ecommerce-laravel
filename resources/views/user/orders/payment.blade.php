@extends('layouts.app')

@section('title', 'Pembayaran - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Pembayaran</h1>
            <p class="text-xl max-w-3xl mx-auto">Selesaikan pembayaran untuk memulai pengerjaan desain Anda</p>
        </div>
    </section>

    <!-- Payment Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <div class="mb-8 text-center">
                        <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 mx-auto mb-4">
                            <i class="fas fa-credit-card text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Detail Pembayaran</h2>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Order ID:</span>
                                <span class="text-gray-800">#{{ $order->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Layanan:</span>
                                <span class="text-gray-800">{{ $order->service->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Metode Pengiriman:</span>
                                <span class="text-gray-800">{{ $order->delivery_method }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Harga:</span>
                                <span class="text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            @if($order->discount_amount > 0)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diskon:</span>
                                <span class="text-green-600">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between text-lg font-semibold pt-2 border-t border-gray-200 mt-2">
                                <span>Total Pembayaran:</span>
                                <span>Rp {{ number_format($order->total_price_after_discount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    @if($order->payment_method == 'QRIS')
                        <div class="text-center mb-8">
                            <h3 class="text-xl font-semibold mb-4">Scan QRIS untuk Melakukan Pembayaran</h3>
                            <div class="bg-white p-4 inline-block rounded-lg shadow mb-4">
                                <div id="qris-container" class="w-64 h-64 mx-auto bg-gray-100 flex items-center justify-center">
                                    <span id="loading-qris">Memuat QRIS...</span>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-2">Scan dengan aplikasi e-wallet atau mobile banking</p>
                            <p class="text-gray-600 text-sm">QRIS berlaku untuk semua aplikasi pembayaran</p>
                        </div>
                    @else
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold mb-4">Pembayaran via Transfer Bank</h3>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                                        <div>
                                            <p class="font-medium">Bank BCA</p>
                                            <p class="text-gray-600">a.n. DesignArt Studio</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-mono text-lg font-semibold">1234567890</p>
                                        </div>
                                    </div>
                                    <p class="text-center text-sm text-gray-600">
                                        Mohon transfer tepat hingga 3 digit terakhir untuk memudahkan verifikasi
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="text-center">
                        <button id="pay-button" class="bg-indigo-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-indigo-700 transition">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="max-w-3xl mx-auto mt-8 text-center">
                <a href="{{ route('user.orders.index') }}" class="text-indigo-600 hover:underline inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pesanan
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://app.{{ config('services.midtrans.is_production') ? '' : 'sandbox.' }}midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const payButton = document.getElementById('pay-button');
        
        payButton.addEventListener('click', function() {
            // Call snap.pay with the snap token
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = '{{ route('user.orders.index') }}?status=success';
                },
                onPending: function(result) {
                    window.location.href = '{{ route('user.orders.index') }}?status=pending';
                },
                onError: function(result) {
                    window.location.href = '{{ route('user.orders.index') }}?status=error';
                },
                onClose: function() {
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        });
    });
</script>
@endpush