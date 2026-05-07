@php
    $footerSettings = \App\Models\SiteSetting::getGroup('footer');
@endphp
<footer class="bg-[#2D1B10] text-[#FDFBF7] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-4 gap-12">
        <div class="col-span-1 md:col-span-2">
            <h2 class="text-3xl font-serif font-bold mb-6">{{ $footerSettings['brand_name'] ?? 'Ara' }}<span class="text-[#D4A373]">{{ $footerSettings['brand_accent'] ?? 'CAFÉ' }}</span></h2>
            <p class="text-[#FDFBF7]/60 max-w-sm mb-8 leading-relaxed">
                {{ $footerSettings['tagline'] ?? 'Crafting moments of clarity and warmth through the art of specialty coffee. Join us in our journey of flavor and community.' }}
            </p>
            <div class="flex space-x-6">
                <a href="{{ $footerSettings['instagram_url'] ?? '#' }}" class="hover:text-[#D4A373] transition-colors uppercase text-xs font-bold tracking-widest">Instagram</a>
                <a href="{{ $footerSettings['tiktok_url'] ?? '#' }}" class="hover:text-[#D4A373] transition-colors uppercase text-xs font-bold tracking-widest">TikTok</a>
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
        <p>{{ $footerSettings['copyright'] ?? '© 2024 Café Collective. All rights reserved.' }}</p>
        <p>{{ $footerSettings['bottom_text'] ?? 'Built with Passion and Caffeine.' }}</p>
    </div>
</footer>