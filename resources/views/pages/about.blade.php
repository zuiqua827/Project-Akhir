@extends('layouts.app')

@section('content')
@php
    $footerSettings = \App\Models\SiteSetting::getGroup('footer');
    $brandName = trim((string) ($footerSettings['brand_name'] ?? 'Ara'));
    $brandAccent = trim((string) ($footerSettings['brand_accent'] ?? 'Cafe'));
    $brandText = trim($brandName . ' ' . $brandAccent);
    if ($brandText === '') {
        $brandText = 'kedai kami';
    }

    $values = [
        ['icon' => 'fa-solid fa-gem', 'title' => 'Kualitas Utama', 'desc' => 'Kami hanya memilih biji single-origin terbaik dari kebun etis di berbagai daerah.'],
        ['icon' => 'fa-solid fa-leaf', 'title' => 'Keberlanjutan', 'desc' => 'Setiap tahap proses kami dirancang untuk meminimalkan dampak lingkungan.'],
        ['icon' => 'fa-solid fa-people-group', 'title' => 'Komunitas', 'desc' => 'Kami percaya kopi adalah jembatan untuk koneksi dan percakapan yang bermakna.'],
        ['icon' => 'fa-solid fa-wand-magic-sparkles', 'title' => 'Keahlian', 'desc' => 'Barista kami dilatih berbulan-bulan untuk menyempurnakan setiap cangkir yang disajikan.'],
    ];

    $timeline = [
        ['year' => '2024', 'title' => 'Awal Baru', 'desc' => $brandText . ' membuka pintu untuk menghadirkan kopi spesialti ke tengah kota Jakarta.'],
        ['year' => 'Q2 2024', 'title' => 'Keluarga yang Bertumbuh', 'desc' => 'Kami meluncurkan program loyalitas dan menyambut lebih dari 10.000 pelanggan.'],
        ['year' => 'Q3 2024', 'title' => 'Kemitraan Langsung', 'desc' => 'Kami menjalin kemitraan langsung dengan petani kopi di Sumatra dan Jawa.'],
        ['year' => 'Q4 2024', 'title' => 'Pengakuan', 'desc' => 'Dianugerahi sebagai kedai kopi spesialti terbaik di Jakarta oleh kritikus kuliner lokal.'],
    ];

    $heroSettings = \App\Models\SiteSetting::getGroup('about_hero');
@endphp

{{-- Hero Section --}}
<section class="relative pt-24 sm:pt-28 md:pt-32 pb-14 sm:pb-16 md:pb-20 bg-[#FDFBF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 lg:gap-16 items-center">
            <div>
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $heroSettings['badge'] ?? 'cerita kami' }}</span>
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-serif leading-[1.1] mb-6 sm:mb-8 text-[#2D1B10]">
                    {{ $heroSettings['title'] ?? 'Lebih dari sekadar' }} <span class="italic text-[#D4A373]">{{ $heroSettings['subtitle'] ?? 'Kopi.' }}</span>
                </h1>
                <p class="text-base md:text-lg text-[#2D1B10]/70 mb-5 sm:mb-6 leading-relaxed">
                    {{ $heroSettings['description1'] ?? ('Di ' . $brandText . ', kami percaya kopi adalah sebuah ritual, bukan sekadar minuman. Biji kopi kami dipilih secara etis dari dataran tinggi terbaik dan dipanggang dalam batch kecil untuk menjaga karakter rasanya.') }}
                </p>
                <p class="text-base md:text-lg text-[#2D1B10]/70 mb-8 sm:mb-10 leading-relaxed">
                    {{ $heroSettings['description2'] ?? 'Baik saat kamu mencari sudut tenang untuk merenung maupun ruang hangat untuk terhubung, pintu kami selalu terbuka untuk menghadirkan rasa dan pengalaman terbaik.' }}
                </p>
            </div>
            <div class="relative">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ $heroSettings['image1'] ?? 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&q=80&w=800' }}" class="w-full h-full object-cover" alt="Meracik kopi">
                </div>
                <div class="absolute -bottom-10 -left-10 hidden md:block w-72 aspect-square rounded-3xl overflow-hidden border-8 border-white shadow-2xl">
                    <img src="{{ $heroSettings['image2'] ?? 'https://images.unsplash.com/photo-1507133750040-4a8f57021571?auto=format&fit=crop&q=80&w=600' }}" class="w-full h-full object-cover" alt="Cangkir kopi">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values Section --}}
<section class="py-16 sm:py-20 md:py-24 bg-[#2D1B10]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        <div class="text-center mb-12 sm:mb-14 md:mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-[#FDFBF7] mb-6">Yang Menggerakkan Kami</h2>
            <p class="text-[#FDFBF7]/60 max-w-2xl mx-auto">Prinsip kami memandu setiap keputusan, dari biji hingga tersaji di cangkir.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
@foreach($values as $value)
            <div class="text-center p-6 sm:p-8 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:border-[#D4A373]/30 transition-all duration-500">
                <div class="text-4xl mb-6 text-[#D4A373]"><i class="{{ $value['icon'] }}"></i></div>
                <h3 class="text-xl font-serif font-bold text-[#FDFBF7] mb-4">{{ $value['title'] }}</h3>
                <p class="text-[#FDFBF7]/50 text-sm leading-relaxed">{{ $value['desc'] }}</p>
            </div>
@endforeach
        </div>
    </div>
</section>

{{-- Story Timeline --}}
{{-- <section class="py-16 sm:py-20 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        <div class="text-center mb-12 sm:mb-14 md:mb-16">
            <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">perjalanan kami</span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-[#2D1B10]">Perjalanan Kami</h2>
        </div>
        <div class="relative"> --}}
            {{-- Timeline Line --}}
            {{-- <div class="absolute left-1/2 top-0 bottom-0 w-px bg-[#2D1B10]/10 hidden md:block transform -translate-x-1/2"></div>
            
            <div class="space-y-16">
@foreach($timeline as $index => $item)
                <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-center">
                    <div class="{{ $index % 2 === 0 ? 'md:text-right md:pr-16' : 'md:order-2 md:pl-16' }}">
                        <div class="inline-block">
                            <span class="text-4xl sm:text-5xl md:text-6xl font-serif text-[#D4A373]/20 font-bold">{{ $item['year'] }}</span>
                        </div>
                    </div>
                    <div class="{{ $index % 2 === 0 ? 'md:order-2 md:pl-16' : 'md:text-right md:pr-16' }}">
                        <h3 class="text-xl sm:text-2xl font-serif font-bold text-[#2D1B10] mb-3">{{ $item['title'] }}</h3>
                        <p class="text-[#2D1B10]/60 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                    {{-- Timeline Dot --}}
                    {{-- <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-[#D4A373] rounded-full hidden md:block ring-4 ring-white"></div>
                </div>
@endforeach
            </div>
        </div>
    </div>
</section> --}} 

{{-- Team Section --}}
@php
    $teamMembers = \App\Models\TeamMember::ordered()->get();
@endphp
<section class="py-16 sm:py-20 md:py-24 bg-[#FDFBF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        <div class="text-center mb-12 sm:mb-14 md:mb-16">
            <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">orang-orang kami</span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Kenali Tim Kami</h2>
            <p class="text-[#2D1B10]/60 max-w-2xl mx-auto">Orang-orang penuh semangat di balik setiap cangkir terbaik.</p>
        </div>
        @if($teamMembers->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($teamMembers as $member)
            <div class="group text-center">
                <div class="aspect-[3/4] rounded-3xl overflow-hidden mb-6 shadow-lg">
                    @if($member->image)
                        <img src="{{ $member->image }}" class="w-full h-full object-cover transition-transform duration-700" alt="{{ $member->name }}">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-6xl"><i class="fa-solid fa-user"></i></div>
                    @endif
                </div>
                <h3 class="text-xl font-serif font-bold text-[#2D1B10] mb-1">{{ $member->name }}</h3>
                <p class="text-[#D4A373] text-sm font-bold uppercase tracking-widest">{{ $member->role }}</p>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-[#2D1B10]/40 text-lg">Anggota tim segera hadir...</p>
        </div>
        @endif
    </div>
</section>

<!-- {{-- CTA Section --}}
<section class="py-24 bg-[#D4A373]">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Kunjungi kami hari ini.</h2>
        <p class="text-[#2D1B10] text-lg mb-10 opacity-80">Rasakan bedanya secara langsung.</p>
        <a href="{{ route('contact') }}" class="inline-block px-12 py-5 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-sm hover:bg-[#FDFBF7] hover:text-[#2D1B10] transition-all">
            Lihat Rute
        </a>
    </div>
</section> -->
@endsection
