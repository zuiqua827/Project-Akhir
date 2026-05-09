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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
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

        [x-cloak] {
            display: none !important;
        }

        img,
        video,
        svg,
        canvas {
            max-width: 100%;
        }

        @media (max-width: 1023px) {
            html,
            body {
                overflow-x: hidden;
            }

            input,
            select,
            textarea {
                font-size: 16px;
            }
        }
    </style>
</head>
<body class="bg-[#FDFBF7] text-[#2D1B10] antialiased overflow-x-hidden">
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
