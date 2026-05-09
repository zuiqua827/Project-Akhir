@php
    $footerSettings = \App\Models\SiteSetting::getGroup('footer');
@endphp
<footer class="bg-[#2D1B10] text-[#FDFBF7] py-14 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-12">
        <div class="col-span-1 md:col-span-2">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-[#D4A373] mb-6">Ara Cafe</p>
            <p class="text-[#FDFBF7]/60 max-w-sm mb-8 leading-relaxed">
                {{ $footerSettings['tagline'] ?? 'Meracik momen hangat dan penuh makna melalui seni kopi spesialti. Mari menikmati perjalanan rasa dan kebersamaan bersama kami.' }}
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
            <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4A373] mb-6">Alamat</h4>
            <p class="text-[#FDFBF7]/80 leading-relaxed">
                {!! nl2br(e($footerSettings['address'] ?? "Jl. KH Achmad Fauzan No.17\nKrasak, Bangsri, Jepara")) !!}
            </p>
        </div>
        <div>
            <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4A373] mb-6">Kontak</h4>
            <p class="text-[#FDFBF7]/80 leading-relaxed">
                {{ $footerSettings['email'] ?? 'hello@cafe.com' }}<br>
                {{ $footerSettings['phone'] ?? '+62 822-2300-5860' }}
            </p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 mt-12 md:mt-20 pt-8 border-t border-white/5 flex flex-col gap-2 md:gap-0 md:flex-row justify-between text-[10px] uppercase tracking-widest text-[#FDFBF7]/40">
         <p class="leading-relaxed">{{ $footerSettings['copyright'] ?? 'Hak Cipta 2024 Ara Cafe. Seluruh hak cipta dilindungi.' }}</p>
        <p class="leading-relaxed">{{ $footerSettings['bottom_text'] ?? 'Dibuat dengan semangat dan secangkir kafein.' }}</p>
    </div>
</footer>
