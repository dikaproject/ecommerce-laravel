@extends('layouts.admin')

@section('title', 'Edit Portofolio - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Portofolio</h1>
        <p class="text-gray-600">Perbarui detail portofolio</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.portofolios.update', $portofolio) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Judul Portofolio</label>
                <input type="text" name="title" id="title" value="{{ old('title', $portofolio->title) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('title') border-red-500 @enderror" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="service_id" class="block text-gray-700 font-medium mb-2">Kategori Layanan</label>
                <select name="service_id" id="service_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('service_id') border-red-500 @enderror" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ (old('service_id', $portofolio->service_id) == $service->id) ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
                @error('service_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $portofolio->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Gambar Saat Ini</label>
                <div class="w-32 h-32 border rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $portofolio->image_url) }}" alt="{{ $portofolio->title }}" class="w-full h-full object-cover">
                </div>
            </div>
            
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Ganti Gambar (Kosongkan jika tidak ingin mengubah)</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('image') border-red-500 @enderror" accept="image/*">
                <p class="text-gray-500 text-sm mt-1">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.portofolios.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg mr-2">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                    Perbarui Portofolio
                </button>
            </div>
        </form>
    </div>
</div>
@endsection