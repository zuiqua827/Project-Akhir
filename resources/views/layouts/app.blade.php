<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Café | Premium Coffee Experience' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Custom AOS tweaks */
        [data-aos] {
            will-change: transform, opacity;
        }
        
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-[#FDFBF7] text-[#2D1B10] antialiased">
    <x-navbar />
    
<main>
        @yield('content')
    </main>

    <x-footer />
    
    <!-- Initialize AOS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 500,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100,
                disable: function() {
                    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                }
            });
        });
    </script>
</body>
</html>
