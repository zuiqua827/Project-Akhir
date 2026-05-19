@extends('layouts.app')

@section('content')
@php
    use App\Models\Product;

    $products = Product::where('is_featured', true)->where('is_available', true)->take(8)->get();

    $moments = App\Models\Moment::ordered()->get();

    $heroSettings = \App\Models\SiteSetting::getGroup('home_hero');
    $gallerySettings = \App\Models\SiteSetting::getGroup('home_gallery');
    $locationSettings = \App\Models\SiteSetting::getGroup('home_location');
@endphp

    {{-- Hero Section --}}
    <section id="home" class="relative min-h-[85vh] md:min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-[#FDFBF7] via-[#FDFBF7]/80 to-transparent z-10"></div>
            <img src="{{ $heroSettings['background_image'] ?? 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=2000' }}" class="w-full h-full object-cover" alt="Interior cafe">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-20 w-full">
            <div class="max-w-2xl">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $heroSettings['badge'] ?? 'Est. 2024' }}</span>
                <h1 class="text-4xl sm:text-5xl md:text-8xl font-serif leading-[1.1] mb-6 sm:mb-8 text-[#2D1B10]">
                    {!! nl2br(e($heroSettings['title'] ?? 'Diseduh Segar')) !!} <br><span class="italic text-[#D4A373]">{{ $heroSettings['subtitle'] ?? 'Untukmu.' }}</span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-[#2D1B10]/70 mb-5 sm:mb-6 leading-relaxed max-w-lg">
                    {{ $heroSettings['description'] ?? 'Nikmati keseimbangan sempurna antara teknik roasting artisan dan suasana hangat di setiap cangkir yang kami sajikan.' }}
                </p>
                <p class="text-[#2D1B10]/50 mb-8 sm:mb-12 text-sm leading-relaxed">
                    {{ $heroSettings['sub_description'] ?? 'Biji kopi pilihan dari sumber berkelanjutan, dipanggang dalam batch kecil.' }}
                </p>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-6">
                    <a href="{{ route('menu') }}" class="w-full sm:w-auto text-center px-8 sm:px-10 py-4 sm:py-5 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-xs hover:bg-[#4A2C1C] transition-all shadow-xl shadow-[#2D1B10]/20">
                        {{ $heroSettings['cta_text'] ?? 'Lihat Menu' }}
                    </a>
                    <a href="{{ route('about') }}" class="w-full sm:w-auto text-center px-8 sm:px-10 py-4 sm:py-5 border border-[#2D1B10] text-[#2D1B10] rounded-full font-bold uppercase tracking-widest text-xs hover:bg-[#2D1B10] hover:text-white transition-all">
                        Cerita Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Best Seller Section --}}
    <section id="bestseller" class="py-16 sm:py-20 md:py-24 lg:py-32 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16 md:mb-20">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif mb-5 sm:mb-6">Produk <span class="italic text-[#D4A373]">Terlaris</span></h2>
                <div class="w-20 h-1 bg-[#D4A373] mx-auto mb-8"></div>
                <p class="text-[#2D1B10]/60">Minuman favorit yang paling disukai pelanggan kami.</p>
            </div>

            @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <a href="{{ route('menu.show', $product->slug) }}" class="group block bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="h-56 sm:h-60 md:h-64 overflow-hidden relative">
                            <img src="{{ $product->image }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $product->name }}">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                {{ $product->formatted_price }}
                            </div>
                        </div>
                        <div class="p-6 sm:p-7 md:p-8">
                            <h3 class="text-xl font-serif font-bold mb-3 group-hover:text-[#D4A373] transition-colors">{{ $product->name }}</h3>
                            <p class="text-[#2D1B10]/50 text-sm leading-relaxed">{{ \Illuminate\Support\Str::limit($product->description ?? 'Belum ada penjelasan produk.', 95) }}</p>
                            <p class="mt-3 text-xs font-semibold tracking-[0.15em] uppercase text-[#D4A373]">Lihat Penjelasan</p>
                        </div>
                    </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-16">
                <p class="text-[#2D1B10]/40 text-lg">Produk terlaris segera hadir...</p>
            </div>
            @endif
        </div>
    </section>

    {{-- Gallery Section (Instagram-style) --}}
    <section class="py-16 sm:py-20 md:py-24 bg-[#2D1B10]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center mb-12 sm:mb-14 md:mb-16" data-aos="fade-up">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $gallerySettings['badge'] ?? 'Momen Kami' }}</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-[#FDFBF7]">{{ $gallerySettings['title'] ?? 'Galeri' }}</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
                @forelse($moments as $index => $moment)
                    <div class="group relative aspect-square overflow-hidden rounded-2xl" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <img src="{{ $moment->image }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $moment->caption }}">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <span class="text-white font-serif text-lg">{{ $moment->caption }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <p>Galeri segera hadir...</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>



    {{-- Location --}}
    <section id="location" class="py-16 sm:py-20 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 lg:gap-16 items-center">
                <div>
                    <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $locationSettings['badge'] ?? 'Kunjungi Kami' }}</span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif mb-5 sm:mb-6 leading-tight">{{ $locationSettings['title'] ?? 'Temukan' }} <span class="italic text-[#D4A373]">{{ $locationSettings['subtitle'] ?? 'Ruang Nyamanmu.' }}</span></h2>
                    <p class="text-[#2D1B10]/60 mb-7 sm:mb-8 text-base sm:text-lg">
                        {{ $locationSettings['description'] ?? 'Berada di jantung Jepara, cafe kami menghadirkan suasana hangat yang cocok untuk bekerja, bersantai, atau berkumpul bersama teman.' }}
                    </p>
                    <div class="space-y-4 mb-8 sm:mb-10">
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-[#2D1B10]/70">{{ $locationSettings['address'] ?? 'Jl. KH Achmad Fauzan No.17, Krasak, Bangsri' }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[#2D1B10]/70">{{ $locationSettings['hours'] ?? 'Buka Setiap Hari: 07:00 - 21:00 WIB' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 px-8 py-4 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-xs hover:bg-[#4A2C1C] transition-all">
                        {{ $locationSettings['cta_text'] ?? 'Lihat Rute' }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                <div class="rounded-2xl overflow-hidden shadow-2xl h-72 sm:h-80 lg:h-96">
                    @php
                        $mapsQuery = $locationSettings['maps_query'] ?? 'Krasak, Bangsri, Jepara, Jawa Tengah';
                        $mapsUrl = 'https://maps.google.com/maps?q=' . urlencode($mapsQuery) . '&output=embed';
                    @endphp
                    <iframe 
                        src="{{ $mapsUrl }}" 
                        width="100%" 
                        height="100%" 
                        style="border:0; filter: grayscale(100%) saturate(0);" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- {{-- CTA Section --}}
    <section class="py-32 bg-[#D4A373]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-5xl md:text-6xl font-serif text-[#2D1B10] mb-10">Siap merasakan bedanya?</h2>
            <p class="text-[#2D1B10] text-lg mb-12 opacity-80 uppercase tracking-widest font-bold">Temukan cangkir favoritmu bersama kami</p>
            <a href="{{ route('menu') }}" class="inline-block px-12 py-6 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-sm hover:bg-[#FDFBF7] hover:text-[#2D1B10] transition-all">
                Lihat Menu
            </a>
        </div>
    </section> -->
@endsection
