<nav class="bg-white shadow-md py-4 fixed w-full z-50">
    <div class="container mx-auto px-4 md:px-6 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">DesignArt Studio</a>
        
        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-8">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 transition {{ request()->routeIs('home') ? 'text-indigo-600 font-medium' : '' }}">Home</a>
            <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-indigo-600 transition {{ request()->routeIs('services.*') ? 'text-indigo-600 font-medium' : '' }}">Layanan</a>
            <a href="{{ route('portfolios.index') }}" class="text-gray-700 hover:text-indigo-600 transition {{ request()->routeIs('portfolios.*') ? 'text-indigo-600 font-medium' : '' }}">Portofolio</a>
            
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 transition">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 transition">Register</a>
            @else
                <div class="relative">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('user.orders.index') }}" class="text-gray-700 hover:text-indigo-600 transition {{ request()->routeIs('user.orders.*') ? 'text-indigo-600 font-medium' : '' }}">Pesanan Saya</a>
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-indigo-600 transition">Logout</button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
        
        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white py-4 px-4 shadow-inner">
        <div class="flex flex-col space-y-4">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 transition {{ request()->routeIs('home') ? 'text-indigo-600 font-medium' : '' }}">Home</a>
            <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-indigo-600 transition {{ request()->routeIs('services.*') ? 'text-indigo-600 font-medium' : '' }}">Layanan</a>
            <a href="{{ route('portfolios.index') }}" class="text-gray-700 hover:text-indigo-600 transition {{ request()->routeIs('portfolios.*') ? 'text-indigo-600 font-medium' : '' }}">Portofolio</a>
            
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 transition">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 transition">Register</a>
            @else
                <a href="{{ route('user.orders.index') }}" class="text-gray-700 hover:text-indigo-600 transition {{ request()->routeIs('user.orders.*') ? 'text-indigo-600 font-medium' : '' }}">Pesanan Saya</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-indigo-600 transition">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>