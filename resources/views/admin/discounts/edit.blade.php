@extends('layouts.admin')

@section('title', 'Edit Diskon - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Diskon</h1>
        <p class="text-gray-600">Perbarui informasi kode diskon</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.discounts.update', $discount) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="code" class="block text-gray-700 font-medium mb-2">Kode Diskon</label>
                <input type="text" name="code" id="code" value="{{ old('code', $discount->code) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('code') border-red-500 @enderror" required>
                @error('code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $discount->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="discount_type" class="block text-gray-700 font-medium mb-2">Tipe Diskon</label>
                <select name="discount_type" id="discount_type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('discount_type') border-red-500 @enderror" required>
                    <option value="Percentage" {{ old('discount_type', $discount->discount_type) == 'Percentage' ? 'selected' : '' }}>Persentase (%)</option>
                    <option value="Fixed" {{ old('discount_type', $discount->discount_type) == 'Fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
                </select>
                @error('discount_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="value" class="block text-gray-700 font-medium mb-2">Nilai Diskon</label>
                <input type="number" name="value" id="value" value="{{ old('value', $discount->value) }}" step="0.01" min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('value') border-red-500 @enderror" required>
                @error('value')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4" id="max-discount-field">
                <label for="max_discount" class="block text-gray-700 font-medium mb-2">Diskon Maksimal (Rp) (Opsional)</label>
                <input type="number" name="max_discount" id="max_discount" value="{{ old('max_discount', $discount->max_discount) }}" step="0.01" min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('max_discount') border-red-500 @enderror">
                <p class="text-gray-500 text-sm mt-1">Kosongkan jika tidak ada batas maksimal</p>
                @error('max_discount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="valid_from" class="block text-gray-700 font-medium mb-2">Tanggal Mulai</label>
                    <input type="datetime-local" name="valid_from" id="valid_from" value="{{ old('valid_from', $discount->valid_from->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('valid_from') border-red-500 @enderror" required>
                    @error('valid_from')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="valid_until" class="block text-gray-700 font-medium mb-2">Tanggal Berakhir</label>
                    <input type="datetime-local" name="valid_until" id="valid_until" value="{{ old('valid_until', $discount->valid_until->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('valid_until') border-red-500 @enderror" required>
                    @error('valid_until')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="service_id" class="block text-gray-700 font-medium mb-2">Terapkan Untuk Layanan (Opsional)</label>
                <select name="service_id" id="service_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('service_id') border-red-500 @enderror">
                    <option value="">Semua Layanan</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id', $discount->service_id) == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-gray-500 text-sm mt-1">Kosongkan untuk menerapkan diskon ke semua layanan</p>
                @error('service_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.discounts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg mr-2">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                    Perbarui Diskon
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const discountTypeSelect = document.getElementById('discount_type');
        const maxDiscountField = document.getElementById('max-discount-field');
        
        function toggleMaxDiscountField() {
            if (discountTypeSelect.value === 'Percentage') {
                maxDiscountField.style.display = 'block';
            } else {
                maxDiscountField.style.display = 'none';
            }
        }
        
        // Call on page load
        toggleMaxDiscountField();
        
        // Add event listener
        discountTypeSelect.addEventListener('change', toggleMaxDiscountField);
    });
</script>
@endpush