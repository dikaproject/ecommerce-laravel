@extends('layouts.admin')

@section('title', 'Edit Pengguna - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Pengguna</h1>
        <p class="text-gray-600">Perbarui informasi pengguna</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('phone') border-red-500 @enderror">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium mb-2">Role</label>
                <select name="role" id="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('role') border-red-500 @enderror" required>
                    <option value="user" {{ (old('role', $user->role) == 'user') ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg mr-2">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                    Perbarui Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection