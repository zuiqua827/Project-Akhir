<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $adminBrandSettings = \App\Models\SiteSetting::getGroup('footer');
        $adminBrandName = trim((string) ($adminBrandSettings['brand_name'] ?? 'Ara'));
        $adminBrandAccent = trim((string) ($adminBrandSettings['brand_accent'] ?? 'Cafe'));
        $adminBrandText = trim($adminBrandName . ' ' . $adminBrandAccent);
        if ($adminBrandText === '') {
            $adminBrandText = 'Brand';
        }
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? ('Panel Admin - ' . $adminBrandText) }}</title>
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
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
                <x-brand-logo :href="route('admin.dashboard')" height-class="h-10" text-class="text-lg font-bold text-gray-800" accent-class="text-[#D4A373]" />
            </div>

            {{-- Navigation --}}
            <nav class="mt-6 px-3 pb-6 space-y-1">
                <!-- Main Section -->
                <div class="mb-6">
                    <p class="px-4 py-2 text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Utama</p>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-chart-line w-5 text-center"></i>
                        <span>Dasbor</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.products.*', 'admin.product-categories.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-box w-5 text-center"></i>
                        <span>Produk</span>
                    </a>
                </div>

                <!-- Website Settings Section -->
                <div>
                    <p class="px-4 py-2 text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Pengaturan</p>
                    
                    <!-- Beranda -->
                    <div x-data="{ open: {{ request()->routeIs('admin.settings.home.*', 'admin.settings.best-seller', 'admin.moments.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" :aria-expanded="open.toString()" aria-controls="admin-nav-home" class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.settings.home.*', 'admin.settings.best-seller', 'admin.moments.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-home w-5 text-center"></i>
                                <span>Beranda</span>
                            </div>
                            <i class="fa-solid fa-chevron-down w-4 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div id="admin-nav-home" x-show="open" x-collapse class="pl-8 mt-1 space-y-1 border-l-2 border-gray-200">
                            <a href="{{ route('admin.settings.home.hero') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.home.hero') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Hero Utama
                            </a>
                            <a href="{{ route('admin.settings.best-seller') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.best-seller') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Produk Terlaris
                            </a>
                            <a href="{{ route('admin.settings.home.gallery') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.home.gallery') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Galeri
                            </a>
                            <a href="{{ route('admin.moments.index') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.moments.*') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Momen
                            </a>
                            <a href="{{ route('admin.settings.home.location') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.home.location') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Lokasi
                            </a>
                        </div>
                    </div>

                    <!-- Tentang -->
                    <div x-data="{ open: {{ request()->routeIs('admin.settings.about.*') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="open = !open" :aria-expanded="open.toString()" aria-controls="admin-nav-about" class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.settings.about.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-info w-5 text-center"></i>
                                <span>Tentang</span>
                            </div>
                            <i class="fa-solid fa-chevron-down w-4 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div id="admin-nav-about" x-show="open" x-collapse class="pl-8 mt-1 space-y-1 border-l-2 border-gray-200">
                            <a href="{{ route('admin.settings.about.hero') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.about.hero') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Hero Tentang
                            </a>
                            <a href="{{ route('admin.settings.about.team') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.about.team') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Tim Kami
                            </a>
                        </div>
                    </div>

                    <!-- Menu -->
                    <div x-data="{ open: {{ request()->routeIs('admin.settings.menu.*') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="open = !open" :aria-expanded="open.toString()" aria-controls="admin-nav-menu" class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.settings.menu.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-utensils w-5 text-center"></i>
                                <span>Menu</span>
                            </div>
                            <i class="fa-solid fa-chevron-down w-4 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div id="admin-nav-menu" x-show="open" x-collapse class="pl-8 mt-1 space-y-1 border-l-2 border-gray-200">
                            <a href="{{ route('admin.settings.menu.hero') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.menu.hero') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Hero Menu
                            </a>
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div x-data="{ open: {{ request()->routeIs('admin.settings.contact.*') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="open = !open" :aria-expanded="open.toString()" aria-controls="admin-nav-contact" class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.settings.contact.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-phone w-5 text-center"></i>
                                <span>Kontak</span>
                            </div>
                            <i class="fa-solid fa-chevron-down w-4 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div id="admin-nav-contact" x-show="open" x-collapse class="pl-8 mt-1 space-y-1 border-l-2 border-gray-200">
                            <a href="{{ route('admin.settings.contact.hero') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.contact.hero') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Hero Kontak
                            </a>
                            <a href="{{ route('admin.settings.contact.info') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.contact.info') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Info & Jam
                            </a>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div x-data="{ open: {{ request()->routeIs('admin.settings.footer') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="open = !open" :aria-expanded="open.toString()" aria-controls="admin-nav-footer" class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.settings.footer') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-table-cells-large w-5 text-center"></i>
                                <span>Footer</span>
                            </div>
                            <i class="fa-solid fa-chevron-down w-4 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div id="admin-nav-footer" x-show="open" x-collapse class="pl-8 mt-1 space-y-1 border-l-2 border-gray-200">
                            <a href="{{ route('admin.settings.footer') }}" class="block px-3 py-2 text-xs rounded transition-colors {{ request()->routeIs('admin.settings.footer') ? 'bg-[#D4A373]/10 text-[#D4A373] font-semibold' : 'text-gray-600 hover:text-[#D4A373]' }}">
                                Konten Footer
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Account Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="px-4 py-2 text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Akun</p>
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.profile.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-user w-5 text-center"></i>
                        <span>Edit Profil</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-1">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-all w-full">
                            <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
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
