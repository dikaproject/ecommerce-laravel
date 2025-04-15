<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DesignArt Studio - Jasa Desain Profesional')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-gradient {
            background: linear-gradient(to right, #4F46E5, #7C3AED);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans">
    @include('components.Navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('components.Footer')
    
    <script>
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    
    @stack('scripts')
</body>
</html>