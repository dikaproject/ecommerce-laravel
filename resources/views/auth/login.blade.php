@extends('layouts.app')

@section('title', 'Login - DesignArt Studio')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Masuk ke Akun</h1>
            <p class="text-xl max-w-3xl mx-auto">Akses akun untuk melihat pesanan dan riwayat transaksi</p>
        </div>
    </section>

    <!-- Login Form Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <div class="mb-8 text-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 mx-auto mb-4">
                            <i class="fas fa-user text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Masuk</h2>
                    </div>
                    
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
                    
                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('email') }}" required autofocus>
                        </div>
                        
                        <div>
                            <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                            <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-indigo-700 transition">
                                Masuk
                            </button>
                        </div>
                        
                        <div class="text-center text-gray-600">
                            <p>Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection