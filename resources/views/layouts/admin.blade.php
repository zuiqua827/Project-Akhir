<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Panel Admin - Ara Cafe' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @media (max-width: 1023px) {
            html,
            body {
                overflow-x: hidden;
            }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased overflow-x-hidden">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-64 max-w-[85vw] bg-white border-r border-gray-200 transform transition-transform duration-300 lg:translate-x-0 -translate-x-full overflow-y-auto" id="sidebar">
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
               <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800">
                    <span class="text-[#D4A373]">ARA CAFE</span>
                </a>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dasbor
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Produk
                </a>
                
                {{-- Pengaturan Website Dropdown --}}
                <div x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }" class="mt-4 pt-4 border-t border-gray-200">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Pengaturan Website
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="open" x-collapse class="pl-11 pr-4 mt-2 space-y-1">
                        <!-- Beranda Pages -->
                        <div x-data="{ openBeranda: {{ request()->routeIs('admin.settings.home.*') ? 'true' : 'false' }} }">
                            <button @click="openBeranda = !openBeranda" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span><i class="fa-solid fa-house"></i> Beranda</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openBeranda }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openBeranda" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.home.hero') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.home.hero') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"> <i class="fa-solid fa-house"></i> Bagian Hero</a>
                                <a href="{{ route('admin.settings.best-seller') }}" class="block py-1.5 text-xs  {{ request()->routeIs('admin.settings.best-seller') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"><i class="fa-solid fa-crown"></i>Terlaris</a>
                                <a href="{{ route('admin.settings.home.gallery') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.home.gallery') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"> <i class="fa-solid fa-images"></i> Bagian Galeri</a>
                                <a href="{{ route('admin.moments.index') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.moments.*') ? ' text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"><i class="fa-solid fa-images"></i> Momen</a>
                                <a href="{{ route('admin.settings.home.location') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.home.location') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"><i class="fa-solid fa-location-dot"></i> Bagian Lokasi</a>
                                
                            </div>
                        </div>

                        <!-- Tentang Pages -->
                        <div x-data="{ openTentang: {{ request()->routeIs('admin.settings.about.*') ? 'true' : 'false' }} }">
                            <button @click="openTentang = !openTentang" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span><i class="fa-solid fa-circle-info"></i> Tentang</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openTentang }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openTentang" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.about.hero') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.about.hero') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"> <i class="fa-solid fa-house"></i> Hero & Statistik</a>
                                <a href="{{ route('admin.settings.about.team') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.about.team') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"> <i class="fa-solid fa-users"></i> Bagian Tim</a>
                            </div>
                        </div>

                        <!-- Menu Pages -->
                        <div x-data="{ openMenu: {{ request()->routeIs('admin.settings.menu.*') ? 'true' : 'false' }} }">
                            <button @click="openMenu = !openMenu" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span><i class="fa-solid fa-utensils"></i> Menu</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openMenu }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openMenu" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.menu.hero') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.menu.hero') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"> <i class="fa-solid fa-house"></i> Bagian Hero</a>
                            </div>
                        </div>

                        <!-- Kontak Pages -->
                        <div x-data="{ openKontak: {{ request()->routeIs('admin.settings.contact.*') ? 'true' : 'false' }} }">
                            <button @click="openKontak = !openKontak" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span><i class="fa-solid fa-phone"></i> Kontak</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openKontak }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openKontak" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.contact.hero') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.contact.hero') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"><i class="fa-solid fa-house"></i> Bagian Hero</a>
                                <a href="{{ route('admin.settings.contact.info') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.contact.info') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}"><i class="fa-solid fa-info-circle"></i> Info & Jam Operasional</a>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div x-data="{ openFooter: {{ request()->routeIs('admin.settings.footer') ? 'true' : 'false' }} }">
                            <button @click="openFooter = !openFooter" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span><i class="fa-brands fa-discourse"></i> Footer</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openFooter }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openFooter" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.footer') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.footer') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}">Konten Footer</a>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-gray-200">


                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar
                    </button>
                </form>
            </nav>
        </aside>
        <button id="sidebar-backdrop" type="button" class="fixed inset-0 z-40 bg-black/30 hidden lg:hidden" aria-label="Tutup menu samping"></button>

        {{-- Main Content --}}
        <div class="flex-1 lg:ml-64">
            {{-- Top Header --}}
            <header class="bg-white border-b border-gray-200 h-16 fixed top-0 right-0 left-0 lg:left-64 z-40">
                <div class="flex items-center justify-between h-full px-4 lg:px-8">
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100" aria-label="Buka menu samping" aria-expanded="false" aria-controls="sidebar">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="hidden lg:block">
                        <h1 class="text-lg font-semibold text-gray-800">{{ $header ?? 'Dasbor' }}</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="hidden sm:block text-sm text-gray-600">Selamat datang, {{ auth()->user()->name }}</span>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="pt-16 min-h-screen">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebarBackdrop = document.getElementById('sidebar-backdrop');
        const sidebarLinks = sidebar ? sidebar.querySelectorAll('a') : [];

        const openSidebar = () => {
            sidebar?.classList.remove('-translate-x-full');
            sidebarBackdrop?.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            mobileMenuBtn?.setAttribute('aria-expanded', 'true');
        };

        const closeSidebar = () => {
            sidebar?.classList.add('-translate-x-full');
            sidebarBackdrop?.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            mobileMenuBtn?.setAttribute('aria-expanded', 'false');
        };

        mobileMenuBtn?.addEventListener('click', () => {
            const isClosed = sidebar?.classList.contains('-translate-x-full');

            if (isClosed) {
                openSidebar();
                return;
            }

            closeSidebar();
        });

        sidebarBackdrop?.addEventListener('click', closeSidebar);

        sidebarLinks.forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebar();
                }
            });
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebarBackdrop?.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                mobileMenuBtn?.setAttribute('aria-expanded', 'false');
                return;
            }

            closeSidebar();
        });
    </script>
</body>
</html>
