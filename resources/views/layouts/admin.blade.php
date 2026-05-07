<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Panel -  Café' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 lg:translate-x-0 -translate-x-full" id="sidebar">
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800">
                    <span class="text-[#D4A373]">CAFÉ</span>
                </a>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Products
                </a>
                <a href="{{ route('admin.moments.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.moments.*') ? 'bg-[#D4A373]/10 text-[#D4A373]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zm0 0v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 4v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 10v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 16v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 3h20v2H2V3zM2 7h20v2H2V7zM2 11h20v2H2V11zM2 15h20v2H2V15zM2 19h20v2H2V19z"></path></svg>
                    Moments
                </a>

                {{-- Website Settings Dropdown --}}
                <div x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }" class="mt-4 pt-4 border-t border-gray-200">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Website Settings
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="open" x-collapse class="pl-11 pr-4 mt-2 space-y-1">
                        <!-- Home Pages -->
                        <div x-data="{ openHome: {{ request()->routeIs('admin.settings.home.*') ? 'true' : 'false' }} }">
                            <button @click="openHome = !openHome" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span>🏠 Home</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openHome }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openHome" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.home.hero') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.home.hero') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}">Hero Section</a>
                                <a href="{{ route('admin.settings.home.gallery') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.home.gallery') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}">Gallery Section</a>
                            </div>
                        </div>

                        <!-- About Pages -->
                        <div x-data="{ openAbout: {{ request()->routeIs('admin.settings.about.*') ? 'true' : 'false' }} }">
                            <button @click="openAbout = !openAbout" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span>📖 About</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openAbout }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openAbout" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.about.hero') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.about.hero') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}">Hero & Stats</a>
                            </div>
                        </div>

                        <!-- Menu Pages -->
                        <div x-data="{ openMenu: {{ request()->routeIs('admin.settings.menu.*') ? 'true' : 'false' }} }">
                            <button @click="openMenu = !openMenu" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span>🍽️ Menu</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openMenu }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openMenu" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.menu.hero') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.menu.hero') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}">Hero Section</a>
                            </div>
                        </div>

                        <!-- Contact Pages -->
                        <div x-data="{ openContact: {{ request()->routeIs('admin.settings.contact.*') ? 'true' : 'false' }} }">
                            <button @click="openContact = !openContact" class="flex items-center justify-between w-full py-2 text-sm font-medium text-gray-600 hover:text-[#D4A373]">
                                <span>📞 Contact</span>
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': openContact }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openContact" class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                <a href="{{ route('admin.settings.contact.hero') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.contact.hero') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}">Hero Section</a>
                                <a href="{{ route('admin.settings.contact.info') }}" class="block py-1.5 text-xs {{ request()->routeIs('admin.settings.contact.info') ? 'text-[#D4A373] font-bold' : 'text-gray-500 hover:text-[#D4A373]' }}">Info & Hours</a>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-gray-200">


                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 lg:ml-64">
            {{-- Top Header --}}
            <header class="bg-white border-b border-gray-200 h-16 fixed top-0 right-0 left-0 lg:left-64 z-40">
                <div class="flex items-center justify-between h-full px-4 lg:px-8">
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="hidden lg:block">
                        <h1 class="text-lg font-semibold text-gray-800">{{ $header ?? 'Dashboard' }}</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">Welcome, {{ auth()->user()->name }}</span>
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

        mobileMenuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>
