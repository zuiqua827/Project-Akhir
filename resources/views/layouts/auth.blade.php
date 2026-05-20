<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title ?? 'Ara Coffee & Eatery' }}</title>
        
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* Coffee Theme Accent for Flux Components */
            :root {
                --color-accent: #2D1B10;
                --color-accent-content: #2D1B10;
                --color-accent-foreground: #FDFBF7;
            }
            
            /* Customize flux inputs for the coffee theme */
            [data-flux-control] {
                border-color: #2D1B1020 !important;
                border-radius: 0.5rem !important;
            }
            
            [data-flux-control]:focus {
                border-color: #A67C52 !important;
                box-shadow: 0 0 0 2px #A67C5230 !important;
            }
        </style>

        <script>
            /* Force light mode to prevent text from turning white (Flux dark mode issue) */
            document.documentElement.classList.remove('dark');
        </script>
    </head>
    <body class="min-h-screen font-sans antialiased bg-[#FDFBF7] text-[#2D1B10] selection:bg-[#D4A373] selection:text-white">
        <!-- Force removing dark class if any script adds it -->
        <script>
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.attributeName === 'class' && document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                    }
                });
            });
            observer.observe(document.documentElement, { attributes: true });
        </script>
        
        <div class="flex min-h-screen w-full">
            <!-- Bagian Kiri: Gambar Background & Branding -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-[#2D1B10] items-center justify-center overflow-hidden">
                <div class="absolute inset-0">
                    <img src="{{ \App\Models\SiteSetting::getGroup('home_hero')['background_image'] ?? 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=2000' }}" 
                         class="w-full h-full object-cover opacity-50 mix-blend-overlay" alt="Ara Cafe Background">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#2D1B10]/95 to-[#2D1B10]/60"></div>
                </div>
                
                <div class="relative z-10 p-12 text-[#FDFBF7] max-w-2xl w-full flex flex-col">
                    <div class="flex items-center gap-4 mb-12">
                        <img src="{{ asset('assets/brand-logo-white.png') }}" alt="Ara Coffee Logo" class="h-16 w-auto object-contain drop-shadow-md" onerror="this.src='{{ asset('assets/Logo_Ara-removebg-preview.png') }}'">
                    </div>
                    
                    <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-4">Selamat Datang</span>
                    <h1 class="text-5xl md:text-6xl font-serif leading-[1.15] mb-6 drop-shadow-lg">
                        Masuk ke <br><span class="italic text-[#D4A373]">Ruang Nyamanmu.</span>
                    </h1>
                    <p class="text-[#FDFBF7]/80 text-lg leading-relaxed max-w-md font-light">
                        {{ \App\Models\SiteSetting::getGroup('footer')['tagline'] ?? 'Meracik momen hangat dan penuh makna melalui seni kopi spesialti.' }}
                    </p>
                </div>
            </div>

            <!-- Bagian Kanan: Section Login Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 lg:p-24 relative bg-[#FDFBF7] min-h-screen overflow-y-auto lg:overflow-hidden">
                <!-- Mobile Background Image (Only visible on small screens) -->
                <div class="absolute inset-0 lg:hidden pointer-events-none">
                    <img src="{{ \App\Models\SiteSetting::getGroup('home_hero')['background_image'] ?? 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=2000' }}" 
                         class="w-full h-full object-cover opacity-15" alt="Ara Cafe Background">
                    <div class="absolute inset-0 bg-gradient-to-b from-[#FDFBF7]/60 via-[#FDFBF7]/95 to-[#FDFBF7]"></div>
                </div>

                <!-- Mobile Logo -->
                <div class="lg:hidden w-full max-w-md mb-8 mt-4 flex flex-col items-center justify-center relative z-10">
                    <img src="{{ asset('assets/brand-logo-brown.png') }}" alt="Ara Coffee Logo" class="h-16 w-auto object-contain mb-3 drop-shadow-sm" onerror="this.src='{{ asset('assets/Logo_Ara-removebg-preview.png') }}'">
                </div>

                <div class="w-full max-w-md bg-white/95 backdrop-blur-md p-8 sm:p-10 rounded-2xl shadow-xl shadow-[#2D1B10]/10 border border-[#2D1B10]/10 relative z-10">
                    {{ $slot }}
                </div>
                
                <!-- Elemen Dekoratif di Background Kanan (Desktop Only) -->
                <div class="hidden lg:block absolute top-0 right-0 w-72 h-72 bg-[#D4A373]/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                <div class="hidden lg:block absolute bottom-0 left-0 w-96 h-96 bg-[#A67C52]/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3 pointer-events-none"></div>
                
                <!-- Copyright Footer -->
                <div class="mt-10 lg:mt-0 lg:absolute lg:bottom-6 text-[#2D1B10]/50 text-[11px] font-medium tracking-wide text-center px-4 relative z-10">
                    @php
                        $footerSettings = \App\Models\SiteSetting::getGroup('footer');
                        $brandName = trim((string) ($footerSettings['brand_name'] ?? 'Ara'));
                        $brandAccent = trim((string) ($footerSettings['brand_accent'] ?? 'Cafe'));
                        $brandText = trim($brandName . ' ' . $brandAccent);
                        if ($brandText === '') $brandText = config('app.name', 'Ara Coffee');
                    @endphp
                    {{ $footerSettings['copyright'] ?? ('Hak Cipta ' . date('Y') . ' ' . $brandText . '. Seluruh hak cipta dilindungi.') }}
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>