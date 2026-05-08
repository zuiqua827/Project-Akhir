<nav x-data="{ mobileMenuOpen: false }" class="fixed w-full z-50 bg-[#FDFBF7]/80 backdrop-blur-md border-b border-[#2D1B10]/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-serif font-bold tracking-tighter text-[#2D1B10]">
                ARA <span class="text-[#D4A373]">CAFE</span>
                </a>
            </div>
            
            <div class="hidden md:flex space-x-10 text-sm font-medium uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-[#D4A373] transition-colors {{ request()->routeIs('home') ? 'text-[#D4A373]' : '' }}">Beranda</a>
                <a href="{{ route('about') }}" class="hover:text-[#D4A373] transition-colors {{ request()->routeIs('about') ? 'text-[#D4A373]' : '' }}">Tentang</a>
                <a href="{{ route('menu') }}" class="hover:text-[#D4A373] transition-colors {{ request()->routeIs('menu') ? 'text-[#D4A373]' : '' }}">Menu</a>
                <a href="{{ route('contact') }}" class="hover:text-[#D4A373] transition-colors {{ request()->routeIs('contact') ? 'text-[#D4A373]' : '' }}">Kontak</a>
            </div>

            <div class="hidden md:block">
                <a href="{{ route('menu') }}" class="px-6 py-3 bg-[#2D1B10] text-white text-xs font-bold uppercase tracking-widest rounded-full hover:bg-[#4A2C1C] transition-all">
                    Pesan Sekarang
                </a>
            </div>

            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-[#2D1B10]">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-[#FDFBF7] border-b border-[#2D1B10]/5 px-6 py-8 space-y-4">
        <a href="{{ route('home') }}" class="block text-lg font-serif">Beranda</a>
        <a href="{{ route('about') }}" class="block text-lg font-serif">Tentang</a>
        <a href="{{ route('menu') }}" class="block text-lg font-serif">Menu</a>
        <a href="{{ route('contact') }}" class="block text-lg font-serif">Kontak</a>
    </div>
</nav>
