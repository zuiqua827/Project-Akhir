<nav x-data="{ mobileMenuOpen: false }" x-effect="document.body.classList.toggle('overflow-hidden', mobileMenuOpen)" @keydown.escape.window="mobileMenuOpen = false" class="fixed w-full z-50 bg-[#FDFBF7]/80 backdrop-blur-md border-b border-[#2D1B10]/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        <div class="flex justify-between items-center h-16 md:h-20">
            <div class="flex-shrink-0 flex items-center">
                <x-brand-logo
                    :href="route('home')"
                    height-class="h-10 sm:h-12"
                    setting-group="home_hero"
                    logo-light-key="navbar_logo_light"
                    logo-dark-key="navbar_logo_dark"
                    legacy-logo-key="navbar_logo"
                />
            </div>
            
            <div class="hidden md:flex space-x-10 text-sm font-medium uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-[#D4A373] transition-colors {{ request()->routeIs('home') ? 'text-[#D4A373]' : '' }}">Beranda</a>
                <a href="{{ route('about') }}" class="hover:text-[#D4A373] transition-colors {{ request()->routeIs('about') ? 'text-[#D4A373]' : '' }}">Tentang</a>
                <a href="{{ route('menu') }}" class="hover:text-[#D4A373] transition-colors {{ request()->routeIs('menu') ? 'text-[#D4A373]' : '' }}">Menu</a>
                <a href="{{ route('contact') }}" class="hover:text-[#D4A373] transition-colors {{ request()->routeIs('contact') ? 'text-[#D4A373]' : '' }}">Kontak</a>
            </div>

            {{-- <div class="hidden md:block">
                <a href="{{ route('menu') }}" class="px-6 py-3 bg-[#2D1B10] text-white text-xs font-bold uppercase tracking-widest rounded-full hover:bg-[#4A2C1C] transition-all">
                    Pesan Sekarang
                </a>
            </div> --}}

            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" :aria-expanded="mobileMenuOpen.toString()" aria-controls="mobile-nav-panel" aria-label="Toggle mobile menu" class="p-2 rounded-lg text-[#2D1B10] hover:bg-[#2D1B10]/5 transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-nav-panel" x-cloak x-show="mobileMenuOpen" x-transition.origin.top.duration.200ms @click.outside="mobileMenuOpen = false" class="md:hidden absolute inset-x-0 top-full bg-[#FDFBF7] border-b border-[#2D1B10]/5 px-4 sm:px-6 pt-4 pb-6 shadow-xl shadow-[#2D1B10]/10">
        <div class="space-y-1">
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}" class="block px-3 py-3 text-base font-serif rounded-xl hover:bg-[#2D1B10]/5 {{ request()->routeIs('home') ? 'text-[#D4A373]' : '' }}">Beranda</a>
            <a @click="mobileMenuOpen = false" href="{{ route('about') }}" class="block px-3 py-3 text-base font-serif rounded-xl hover:bg-[#2D1B10]/5 {{ request()->routeIs('about') ? 'text-[#D4A373]' : '' }}">Tentang</a>
            <a @click="mobileMenuOpen = false" href="{{ route('menu') }}" class="block px-3 py-3 text-base font-serif rounded-xl hover:bg-[#2D1B10]/5 {{ request()->routeIs('menu') ? 'text-[#D4A373]' : '' }}">Menu</a>
            <a @click="mobileMenuOpen = false" href="{{ route('contact') }}" class="block px-3 py-3 text-base font-serif rounded-xl hover:bg-[#2D1B10]/5 {{ request()->routeIs('contact') ? 'text-[#D4A373]' : '' }}">Kontak</a>
        </div>
        {{-- <a @click="mobileMenuOpen = false" href="{{ route('menu') }}" class="mt-4 inline-flex w-full items-center justify-center px-5 py-3 bg-[#2D1B10] text-white text-xs font-bold uppercase tracking-widest rounded-full hover:bg-[#4A2C1C] transition-all">
            Pesan Sekarang
        </a> --}}
    </div>
</nav>
