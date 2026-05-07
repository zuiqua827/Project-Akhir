@php
    $footerSettings = \App\Models\SiteSetting::getGroup('footer');
@endphp
<footer class="bg-[#2D1B10] text-[#FDFBF7] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-4 gap-12">
        <div class="col-span-1 md:col-span-2">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-[#D4A373] mb-6">Ara Cafe</p>
            <p class="text-[#FDFBF7]/60 max-w-sm mb-8 leading-relaxed">
                {{ $footerSettings['tagline'] ?? 'Crafting moments of clarity and warmth through the art of specialty coffee. Join us in our journey of flavor and community.' }}
            </p>
            <div class="flex space-x-4">
                <a href="{{ $footerSettings['instagram_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full border border-[#FDFBF7]/20 flex items-center justify-center hover:bg-[#D4A373] hover:border-[#D4A373] hover:scale-110 transition-all duration-300" aria-label="Instagram">
                    <i class="fa-brands fa-instagram text-lg"></i>
                </a>
                <a href="{{ $footerSettings['tiktok_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full border border-[#FDFBF7]/20 flex items-center justify-center hover:bg-[#D4A373] hover:border-[#D4A373] hover:scale-110 transition-all duration-300" aria-label="TikTok">
                    <i class="fa-brands fa-tiktok text-lg"></i>
                </a>
            </div>
        </div>
        <div>
            <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4A373] mb-6">Address</h4>
            <p class="text-[#FDFBF7]/80 leading-relaxed">
                {!! nl2br(e($footerSettings['address'] ?? "123 Roaster Avenue\nCoffee District, NY 10012")) !!}
            </p>
        </div>
        <div>
            <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4A373] mb-6">Contact</h4>
            <p class="text-[#FDFBF7]/80 leading-relaxed">
                {{ $footerSettings['email'] ?? 'hello@cafe.com' }}<br>
                {{ $footerSettings['phone'] ?? '+1 (555) 000-8888' }}
            </p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-20 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between text-[10px] uppercase tracking-widest text-[#FDFBF7]/40">
         <p>{{ $footerSettings['copyright'] ?? 'Copyright 2024 Cafe Collective. All rights reserved.' }}</p>
        <p>{{ $footerSettings['bottom_text'] ?? 'Built with Passion and Caffeine.' }}</p>
    </div>
</footer>
