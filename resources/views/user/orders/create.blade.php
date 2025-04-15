@extends('layouts.app')

@section('title', 'Pesan Jasa - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Pesan Jasa Desain</h1>
            <p class="text-xl max-w-3xl mx-auto">Isi formulir pemesanan di bawah untuk memulai proyek desain Anda bersama kami</p>
        </div>
    </section>

    <!-- Order Form Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 py-6 px-8 border-b">
                    <h2 class="text-2xl font-bold text-gray-800">Form Pemesanan</h2>
                </div>

                <form action="{{ route('user.orders.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    
                    @if($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <p class="font-bold">Terjadi kesalahan:</p>
                            <ul class="list-disc ml-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Service Selection -->
                    <div>
                        <label for="service_id" class="block text-gray-700 font-medium mb-2">Pilih Layanan</label>
                        <select id="service_id" name="service_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Pilih Layanan</option>
                            @foreach($services as $serviceItem)
                                <option value="{{ $serviceItem->id }}" {{ (old('service_id') == $serviceItem->id || (isset($service) && $service->id == $serviceItem->id)) ? 'selected' : '' }}>
                                    {{ $serviceItem->name }} - Rp {{ number_format($serviceItem->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Project Details -->
                    <div>
                        <label for="description" class="block text-gray-700 font-medium mb-2">Detail Proyek</label>
                        <textarea id="description" name="description" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Jelaskan detail kebutuhan desain Anda...">{{ old('description') }}</textarea>
                    </div>
                    
                    <!-- Reference File -->
                    <div>
                        <label for="reference_file" class="block text-gray-700 font-medium mb-2">File Referensi (opsional)</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer">
                            <input type="file" id="reference_file" name="reference_file" class="hidden" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.zip">
                            <label for="reference_file" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                <p class="text-gray-700 font-medium">Klik untuk unggah file</p>
                                <p class="text-sm text-gray-500 mt-1">Atau seret dan lepas file di sini</p>
                                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF, PDF, DOC, ZIP (Maks. 10MB)</p>
                            </label>
                            <div id="file_preview" class="mt-4 hidden">
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-file-alt text-gray-500 mr-3"></i>
                                    <span class="file-name text-gray-700 truncate flex-1"></span>
                                    <button type="button" id="remove_file" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Delivery Method -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Metode Pengiriman Hasil</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center justify-between border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition">
                                <div class="flex items-center">
                                    <input type="radio" name="delivery_method" value="Email" class="form-radio h-5 w-5 text-indigo-600" {{ old('delivery_method') == 'Email' ? 'checked' : '' }}>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-gray-800">Email</h4>
                                        <p class="text-sm text-gray-600">Terima hasil desain di email Anda</p>
                                    </div>
                                </div>
                                <i class="fas fa-envelope text-2xl text-gray-400"></i>
                            </label>
                            
                            <label class="flex items-center justify-between border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition">
                                <div class="flex items-center">
                                    <input type="radio" name="delivery_method" value="WhatsApp" class="form-radio h-5 w-5 text-indigo-600" {{ old('delivery_method') == 'WhatsApp' ? 'checked' : '' }}>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-gray-800">WhatsApp</h4>
                                        <p class="text-sm text-gray-600">Terima hasil desain di WhatsApp Anda</p>
                                    </div>
                                </div>
                                <i class="fab fa-whatsapp text-2xl text-gray-400"></i>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Metode Pembayaran</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center justify-between border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition">
                                <div class="flex items-center">
                                    <input type="radio" name="payment_method" value="QRIS" class="form-radio h-5 w-5 text-indigo-600" {{ old('payment_method') == 'QRIS' ? 'checked' : '' }}>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-gray-800">QRIS</h4>
                                        <p class="text-sm text-gray-600">Bayar dengan scan QRIS</p>
                                    </div>
                                </div>
                                <i class="fas fa-qrcode text-2xl text-gray-400"></i>
                            </label>
                            
                            <label class="flex items-center justify-between border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition">
                                <div class="flex items-center">
                                    <input type="radio" name="payment_method" value="Transfer Bank" class="form-radio h-5 w-5 text-indigo-600" {{ old('payment_method') == 'Transfer Bank' ? 'checked' : '' }}>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-gray-800">Transfer Bank</h4>
                                        <p class="text-sm text-gray-600">Bayar dengan transfer bank</p>
                                    </div>
                                </div>
                                <i class="fas fa-university text-2xl text-gray-400"></i>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Discount Code -->
                    <div>
                        <label for="discount_code" class="block text-gray-700 font-medium mb-2">Kode Diskon (opsional)</label>
                        <div class="flex">
                            <input type="text" id="discount_code" name="discount_code" class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan kode diskon jika ada" value="{{ old('discount_code') }}">
                            <button type="button" id="validate_discount" class="bg-indigo-600 text-white px-4 py-3 rounded-r-lg hover:bg-indigo-700 transition">Validasi</button>
                        </div>
                        <div id="discount_message" class="mt-2"></div>
                    </div>
                    
                    <!-- Price Summary -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Ringkasan Harga</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Harga Layanan:</span>
                                <span class="text-gray-800" id="service_price">Rp 0</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diskon:</span>
                                <span class="text-gray-800" id="discount_amount">- Rp 0</span>
                            </div>
                            <div class="flex justify-between font-semibold border-t border-gray-200 pt-2 mt-2">
                                <span>Total:</span>
                                <span id="total_price">Rp 0</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-indigo-700 transition">
                            Lanjutkan ke Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const serviceSelect = document.getElementById('service_id');
        const discountCode = document.getElementById('discount_code');
        const validateBtn = document.getElementById('validate_discount');
        const fileInput = document.getElementById('reference_file');
        const filePreview = document.getElementById('file_preview');
        const removeFileBtn = document.getElementById('remove_file');
        const servicePriceEl = document.getElementById('service_price');
        const discountAmountEl = document.getElementById('discount_amount');
        const totalPriceEl = document.getElementById('total_price');
        
        let servicePrice = 0;
        let discountAmount = 0;
        
        // Update prices when service changes
        serviceSelect.addEventListener('change', function() {
            if (this.value) {
                const selectedOption = this.options[this.selectedIndex];
                const priceText = selectedOption.textContent.split('-')[1].trim();
                servicePrice = parseInt(priceText.replace(/\D/g,''));
                
                servicePriceEl.textContent = formatPrice(servicePrice);
                updateTotal();
                
                // Reset discount if service changes
                discountAmount = 0;
                discountAmountEl.textContent = '- ' + formatPrice(0);
                document.getElementById('discount_message').innerHTML = '';
            } else {
                servicePrice = 0;
                servicePriceEl.textContent = formatPrice(0);
                updateTotal();
            }
        });
        
        // Validate discount code
        validateBtn.addEventListener('click', function() {
            const code = discountCode.value.trim();
            const serviceId = serviceSelect.value;
            
            if (!code) {
                document.getElementById('discount_message').innerHTML = '<p class="text-red-500">Masukkan kode diskon</p>';
                return;
            }
            
            if (!serviceId) {
                document.getElementById('discount_message').innerHTML = '<p class="text-red-500">Pilih layanan terlebih dahulu</p>';
                return;
            }
            
            // Send AJAX request to validate discount
            fetch('{{ route("user.discount.validate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    code: code,
                    service_id: serviceId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.valid) {
                    document.getElementById('discount_message').innerHTML = `<p class="text-green-500">${data.message}</p>`;
                    discountAmount = data.discount_amount;
                    discountAmountEl.textContent = '- ' + formatPrice(discountAmount);
                    updateTotal();
                } else {
                    document.getElementById('discount_message').innerHTML = `<p class="text-red-500">${data.message}</p>`;
                    discountAmount = 0;
                    discountAmountEl.textContent = '- ' + formatPrice(0);
                    updateTotal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('discount_message').innerHTML = '<p class="text-red-500">Terjadi kesalahan saat memvalidasi kode</p>';
            });
        });
        
        // Handle file upload
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                const fileName = file.name;
                
                filePreview.querySelector('.file-name').textContent = fileName;
                filePreview.classList.remove('hidden');
            }
        });
        
        // Remove uploaded file
        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', function() {
                fileInput.value = '';
                filePreview.classList.add('hidden');
            });
        }
        
        // Format price
        function formatPrice(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
        
        // Update total price
        function updateTotal() {
            const total = Math.max(0, servicePrice - discountAmount);
            totalPriceEl.textContent = formatPrice(total);
        }
        
        // Initialize price if service is already selected
        if (serviceSelect.value) {
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const priceText = selectedOption.textContent.split('-')[1].trim();
            servicePrice = parseInt(priceText.replace(/\D/g,''));
            
            servicePriceEl.textContent = formatPrice(servicePrice);
            updateTotal();
        }
    });
</script>
@endpush