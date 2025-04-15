<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">DesignArt Studio</h3>
                <p class="text-gray-400 mb-4">Solusi desain kreatif untuk meningkatkan brand dan bisnis Anda.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <!-- Links -->
            <div>
                <h3 class="text-xl font-bold mb-4">Layanan</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('services.index') }}#video" class="text-gray-400 hover:text-white transition">Jasa Video Konten</a></li>
                    <li><a href="{{ route('services.index') }}#content" class="text-gray-400 hover:text-white transition">Jasa Desain Konten</a></li>
                    <li><a href="{{ route('services.index') }}#poster" class="text-gray-400 hover:text-white transition">Desain Poster</a></li>
                    <li><a href="{{ route('services.index') }}#ppt" class="text-gray-400 hover:text-white transition">Desain Presentasi PPT</a></li>
                </ul>
            </div>
            
            <!-- Links -->
            <div>
                <h3 class="text-xl font-bold mb-4">Tentang Kami</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Profil Perusahaan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Tim Kami</a></li>
                    <li><a href="{{ route('portfolios.index') }}" class="text-gray-400 hover:text-white transition">Portofolio</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="text-xl font-bold mb-4">Hubungi Kami</h3>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-indigo-400"></i>
                        <span class="text-gray-400">Jl. Kreatif No. 123, Jakarta Selatan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone mt-1 mr-3 text-indigo-400"></i>
                        <span class="text-gray-400">+62 812 3456 7890</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope mt-1 mr-3 text-indigo-400"></i>
                        <span class="text-gray-400">info@designartstudio.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-10 pt-6 text-center">
            <p class="text-gray-400">&copy; {{ date('Y') }} DesignArt Studio. All rights reserved.</p>
        </div>
    </div>
</footer>