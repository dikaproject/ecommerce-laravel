<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - DesignArt Studio')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-gradient {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 py-4 px-6 hidden md:block">
            <div class="flex items-center space-x-2 mb-8">
                <i class="fas fa-paint-brush text-indigo-400"></i>
                <h1 class="text-xl font-bold">DesignArt Admin</h1>
            </div>
            
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-tachometer-alt w-5 mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.services.index') }}" class="block py-2 px-3 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-indigo-700' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-paint-brush w-5 mr-2"></i> Layanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.portofolios.index') }}" class="block py-2 px-3 rounded-lg {{ request()->routeIs('admin.portofolios.*') ? 'bg-indigo-700' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-images w-5 mr-2"></i> Portofolio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="block py-2 px-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-700' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-shopping-cart w-5 mr-2"></i> Pesanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.discounts.index') }}" class="block py-2 px-3 rounded-lg {{ request()->routeIs('admin.discounts.*') ? 'bg-indigo-700' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-tag w-5 mr-2"></i> Diskon
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="block py-2 px-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-indigo-700' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-users w-5 mr-2"></i> Pengguna
                        </a>
                    </li>
                    <li class="mt-8">
                        <a href="{{ route('home') }}" class="block py-2 px-3 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-home w-5 mr-2"></i> Lihat Website
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="block w-full text-left py-2 px-3 rounded-lg hover:bg-gray-700">
                                <i class="fas fa-sign-out-alt w-5 mr-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-md">
                <div class="flex justify-between items-center py-4 px-6">
                    <div class="flex items-center md:hidden">
                        <button id="sidebar-toggle" class="text-gray-700 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-2">{{ Auth::user()->name }}</span>
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-indigo-600"></i>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-6" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-6" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <script>
        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        
        if(sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                mobileSidebar.classList.remove('hidden');
            });
        }
        
        if(closeSidebar) {
            closeSidebar.addEventListener('click', () => {
                mobileSidebar.classList.add('hidden');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>