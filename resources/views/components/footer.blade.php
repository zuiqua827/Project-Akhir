@php
    $footerSettings = \App\Models\SiteSetting::getGroup('footer');
    $brandName = trim((string) ($footerSettings['brand_name'] ?? 'Ara'));
    $brandAccent = trim((string) ($footerSettings['brand_accent'] ?? 'Cafe'));
    $brandText = trim($brandName . ' ' . $brandAccent);
    if ($brandText === '') {
        $brandText = 'Brand Kami';
    }
    $instagramUrl = trim((string) ($footerSettings['instagram_url'] ?? ''));
    $tiktokUrl = trim((string) ($footerSettings['tiktok_url'] ?? ''));
@endphp
<footer class="bg-[#2D1B10] text-[#FDFBF7] py-6 sm:py-8 md:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        <div class="grid grid-cols-2 lg:grid-cols-12 gap-x-5 gap-y-6 sm:gap-y-8 lg:gap-y-0 lg:gap-x-10">
            <!-- Brand Section -->
            <div class="col-span-2 lg:col-span-4">
                <x-brand-logo
                    class="mb-2 sm:mb-3"
                    background="dark"
                    height-class="h-9 sm:h-10"
                    text-class="text-[11px] sm:text-xs font-bold uppercase tracking-[0.18em] sm:tracking-[0.2em] text-[#D4A373]"
                    accent-class="text-[#D4A373]"
                />
                <p class="text-[#FDFBF7]/60 text-xs sm:text-sm mb-3 sm:mb-4 leading-relaxed break-words">
                    {{ $footerSettings['tagline'] ?? 'Meracik momen hangat dan penuh makna melalui seni kopi spesialti.' }}
                </p>
                <div class="flex gap-2.5 sm:gap-3">
                    @if($instagramUrl !== '')
                        <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-[#FDFBF7]/20 flex items-center justify-center hover:bg-[#D4A373] hover:border-[#D4A373] transition-all duration-300" aria-label="Instagram">
                            <i class="fa-brands fa-instagram text-xs sm:text-sm"></i>
                        </a>
                    @else
                        <span class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-[#FDFBF7]/10 flex items-center justify-center text-[#FDFBF7]/35 cursor-not-allowed" aria-hidden="true">
                            <i class="fa-brands fa-instagram text-xs sm:text-sm"></i>
                        </span>
                    @endif

                    @if($tiktokUrl !== '')
                        <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-[#FDFBF7]/20 flex items-center justify-center hover:bg-[#D4A373] hover:border-[#D4A373] transition-all duration-300" aria-label="TikTok">
                            <i class="fa-brands fa-tiktok text-xs sm:text-sm"></i>
                        </a>
                    @else
                        <span class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-[#FDFBF7]/10 flex items-center justify-center text-[#FDFBF7]/35 cursor-not-allowed" aria-hidden="true">
                            <i class="fa-brands fa-tiktok text-xs sm:text-sm"></i>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Navigation Section -->
            <div class="col-span-1 lg:col-span-2">
                <h4 class="text-[11px] sm:text-xs font-bold uppercase tracking-[0.13em] sm:tracking-[0.15em] text-[#D4A373] mb-3 sm:mb-4">Menu</h4>
                <ul class="space-y-1.5 sm:space-y-2.5">
                    <li><a href="{{ route('home') }}" class="text-[#FDFBF7]/80 text-xs sm:text-sm hover:text-[#D4A373] transition-colors duration-300">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="text-[#FDFBF7]/80 text-xs sm:text-sm hover:text-[#D4A373] transition-colors duration-300">Tentang</a></li>
                    <li><a href="{{ route('menu') }}" class="text-[#FDFBF7]/80 text-xs sm:text-sm hover:text-[#D4A373] transition-colors duration-300">Menu</a></li>
                    <li><a href="{{ route('contact') }}" class="text-[#FDFBF7]/80 text-xs sm:text-sm hover:text-[#D4A373] transition-colors duration-300">Kontak</a></li>
                </ul>
            </div>

            <!-- Address Section -->
            <div class="col-span-1 lg:col-span-3">
                <h4 class="text-[11px] sm:text-xs font-bold uppercase tracking-[0.13em] sm:tracking-[0.15em] text-[#D4A373] mb-3 sm:mb-4">Alamat</h4>
                <p class="text-[#FDFBF7]/80 text-xs sm:text-sm leading-relaxed">
                    {!! nl2br(e($footerSettings['address'] ?? "Jl. KH Achmad Fauzan No.17\nKrasak, Bangsri, Jepara")) !!}
                </p>
            </div>

            <!-- Contact Section -->
            <div class="col-span-2 lg:col-span-3">
                <h4 class="text-[11px] sm:text-xs font-bold uppercase tracking-[0.13em] sm:tracking-[0.15em] text-[#D4A373] mb-3 sm:mb-4">Kontak</h4>
                <div class="text-[#FDFBF7]/80 text-xs sm:text-sm leading-relaxed space-y-1.5 sm:space-y-2">
                    <div>{{ $footerSettings['email'] ?? 'hello@cafe.com' }}</div>
                    <div>{{ $footerSettings['phone'] ?? '+62 822-2300-5860' }}</div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-5 sm:mt-6 md:mt-8 pt-4 sm:pt-5 md:pt-6 border-t border-white/10 flex flex-col gap-1.5 sm:gap-2 md:gap-4 md:flex-row md:items-start md:justify-between text-[10px] sm:text-[11px] uppercase md:tracking-wider text-[#FDFBF7]/50 leading-relaxed">
            <p class="break-words md:max-w-[48%]">{{ $footerSettings['copyright'] ?? ('Hak Cipta 2024 ' . $brandText . '. Seluruh hak cipta dilindungi.') }}</p>
            <p class="break-words md:max-w-[48%]">{{ $footerSettings['bottom_text'] ?? 'Dibuat dengan semangat dan secangkir kafein.' }}</p>
        </div>
    </div>
</footer>
