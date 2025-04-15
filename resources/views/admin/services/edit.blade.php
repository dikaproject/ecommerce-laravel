@extends('layouts.admin')

@section('title', 'Edit Layanan - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Layanan</h1>
        <p class="text-gray-600">Perbarui informasi layanan</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Layanan</label>
                <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="price" class="block text-gray-700 font-medium mb-2">Harga (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" step="0.01" min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('price') border-red-500 @enderror" required>
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.services.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg mr-2">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                    Perbarui Layanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection