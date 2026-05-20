@extends('layouts.app')

@section('content')
@php
    use App\Models\Product;
    use Illuminate\Support\Facades\Schema;

    $products = collect();
    $moments = collect();
    $hasProductCategoryTable = false;

    try {
        $hasProductTable = Schema::hasTable((new Product())->getTable());
        $hasProductCategoryTable = Schema::hasTable('product_categories');
        $hasMomentTable = Schema::hasTable((new App\Models\Moment())->getTable());

        if ($hasProductTable) {
            $productsQuery = Product::query()
                ->where('is_featured', true)
                ->where('is_available', true)
                ->orderBy('id')
                ->take(8);

            if ($hasProductCategoryTable) {
                $productsQuery->with('category');
            }

            $products = $productsQuery->get();
        }

        if ($hasMomentTable) {
            $moments = App\Models\Moment::ordered()->get();
        }
    } catch (\Throwable $exception) {
        $products = collect();
        $moments = collect();
        $hasProductCategoryTable = false;
    }

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
                <h1 class="text-4xl sm:text-5xl md:text-8xl font-serif leading-[1.1] mb-6 sm:mb-8 text-[#2D1B10] break-words">
                    {!! nl2br(e($heroSettings['title'] ?? 'Diseduh Segar')) !!} <br><span class="italic text-[#D4A373]">{{ $heroSettings['subtitle'] ?? 'Untukmu.' }}</span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-[#2D1B10]/70 mb-5 sm:mb-6 leading-relaxed max-w-lg break-words">
                    {{ $heroSettings['description'] ?? 'Nikmati keseimbangan sempurna antara teknik roasting artisan dan suasana hangat di setiap cangkir yang kami sajikan.' }}
                </p>
                <p class="text-[#2D1B10]/50 mb-8 sm:mb-12 text-sm leading-relaxed break-words">
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
    <section id="bestseller" class="py-16 sm:py-20 md:py-24 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12 md:mb-14">
                <span class="inline-block text-[#A67C52] font-bold uppercase tracking-[0.22em] text-xs mb-3">Jelajahi</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-[#2D1B10]">Produk Terlaris</h2>
                <p class="mt-4 text-[#2D1B10]/60 text-sm sm:text-base">Pilihan favorit pelanggan yang paling sering dipesan.</p>
                <div class="w-20 h-0.5 bg-[#A67C52] mx-auto mt-4"></div>
            </div>

            @if($products->count() > 0)
                @php
                    $showcaseProducts = $products->take(5)->values();
                    $useMosaicLayout = $showcaseProducts->count() >= 5;
                    $mobileLayout = [
                        'col-span-2',
                        'col-span-1',
                        'col-span-1',
                        'col-span-1',
                        'col-span-1',
                    ];
                    $desktopLayout = [
                        'md:col-span-2 lg:col-span-6 lg:row-span-2',
                        'lg:col-span-3 lg:row-span-1',
                        'lg:col-span-3 lg:row-span-1',
                        'lg:col-span-3 lg:row-span-1',
                        'lg:col-span-3 lg:row-span-1',
                    ];
                    $gridClass = $useMosaicLayout
                        ? 'grid grid-cols-2 lg:grid-cols-12 lg:auto-rows-[230px] gap-1.5 sm:gap-3'
                        : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4';
                @endphp

                <div class="{{ $useMosaicLayout ? 'rounded-2xl sm:rounded-3xl bg-[#F7F2E8] p-2 sm:p-3' : '' }}">
                    <div class="{{ $gridClass }}">
                    @foreach($showcaseProducts as $index => $product)
                        @php
                            $isLeadCard = $useMosaicLayout && $index === 0;
                            $itemClass = $useMosaicLayout
                                ? (($mobileLayout[$index] ?? 'col-span-1') . ' ' . ($desktopLayout[$index] ?? 'lg:col-span-3 lg:row-span-1'))
                                : '';
                            $heightClass = $useMosaicLayout
                                ? ($isLeadCard ? 'h-[230px] sm:h-[360px] lg:h-auto' : 'h-[210px] sm:h-[260px] lg:h-auto')
                                : 'h-[260px] sm:h-[320px]';
                        @endphp
                        <a href="{{ route('best-seller.show', $product->slug) }}" class="group relative overflow-hidden rounded-xl sm:rounded-2xl {{ $heightClass }} {{ $itemClass }}">
                            <img src="{{ $product->image }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $product->name }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent"></div>
                            <div class="absolute inset-0 ring-1 ring-inset ring-white/15"></div>

                            <div class="absolute inset-x-0 bottom-0 p-4 sm:p-5 md:p-6">
                                @php
                                    $categoryLabel = 'Top Selection';
                                    if ($hasProductCategoryTable && $product->relationLoaded('category') && $product->category) {
                                        $categoryLabel = $product->category->name;
                                    }
                                @endphp
                                <p class="text-[9px] sm:text-[10px] font-bold uppercase tracking-[0.14em] text-white/90">
                                    {{ $categoryLabel }}
                                </p>
                                <h3 class="mt-2 font-serif text-white leading-tight {{ $isLeadCard ? 'text-xl sm:text-2xl md:text-3xl lg:text-[1.95rem]' : 'text-lg sm:text-xl md:text-[1.45rem]' }}">
                                    {{ \Illuminate\Support\Str::limit($product->name, $isLeadCard ? 42 : 32) }}
                                </h3>
                                {{-- <p class="mt-2.5 text-[#D4A373] text-[10px] sm:text-xs font-semibold tracking-[0.06em] uppercase">
                                    Lihat Produk
                                </p>
                                <div class="mt-1 h-px bg-[#D4A373]/75"></div> --}}
                            </div>
                        </a>
                    @endforeach
                    </div>
                </div>

                <div class="mt-8 sm:mt-10 text-center">
                    <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 px-7 py-3 rounded-full border border-[#2D1B10]/20 text-[#2D1B10] text-sm font-semibold tracking-[0.08em] uppercase hover:bg-[#2D1B10] hover:text-white hover:border-[#2D1B10] transition-all">
                        Lihat Semua Menu
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-[#2D1B10]/40 text-lg">Produk terlaris segera hadir...</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Gallery Section (Instagram-style) --}}
    <section class="py-16 sm:py-20 md:py-24 bg-[#2D1B10]" x-data="galleryModal()" @keydown.window="handleKeydown($event)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center mb-12 sm:mb-14 md:mb-16" data-aos="fade-up">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $gallerySettings['badge'] ?? 'Momen Kami' }}</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-[#FDFBF7]">{{ $gallerySettings['title'] ?? 'Galeri' }}</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
                @forelse($moments as $index => $moment)
                    <div class="group relative aspect-square overflow-hidden rounded-2xl cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" @click="openModal({{ $index }})">
                        <img src="{{ $moment->image }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $moment->caption }}">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-magnifying-glass text-white text-2xl mb-2 block"></i>
                                <span class="text-white font-serif text-sm sm:text-lg">{{ $moment->caption }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <p>Galeri segera hadir...</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Gallery Modal Lightbox --}}
        <div class="fixed inset-0 z-50 bg-black/95 opacity-0 pointer-events-none transition-opacity duration-300" 
             @click="closeModal()" 
             :class="{ 'opacity-100 pointer-events-auto': isOpen }">
            
            <button @click="closeModal()" class="absolute top-4 right-4 z-10 w-10 h-10 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/40 transition-colors">
                <i class="fas fa-times text-white text-xl"></i>
            </button>

            <div class="h-full flex items-center justify-center p-4">
                <div class="relative w-full max-w-4xl" @click.stop>
                    {{-- Main Image --}}
                    <div class="relative aspect-square md:aspect-auto md:h-[70vh] overflow-hidden rounded-lg">
                        <template x-for="(image, idx) in images" :key="idx">
                            <img 
                                :src="image.src" 
                                :alt="image.caption"
                                x-show="currentIndex === idx"
                                x-transition:enter="transition duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition duration-300"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="w-full h-full object-contain"
                            >
                        </template>
                    </div>

                    {{-- Caption & Info --}}
                    <div class="text-center mt-4 text-white">
                        <p class="text-lg font-serif break-words" x-text="images[currentIndex]?.caption || ''"></p>
                        <p class="text-sm text-gray-400 mt-2" x-text="(currentIndex + 1) + ' / ' + images.length"></p>
                    </div>

                    {{-- Navigation Buttons --}}
                    <button 
                        @click="prevImage()" 
                        :disabled="!hasPrev()"
                        :class="{ 'opacity-50 cursor-not-allowed': !hasPrev() }"
                        class="absolute left-2 sm:left-4 md:left-0 top-1/2 -translate-y-1/2 md:-translate-x-1/2 w-11 h-11 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-md border border-white/10 transition-all disabled:hover:bg-white/20 text-white text-lg md:text-xl shadow-lg"
                    >
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <button 
                        @click="nextImage()" 
                        :disabled="!hasNext()"
                        :class="{ 'opacity-50 cursor-not-allowed': !hasNext() }"
                        class="absolute right-2 sm:right-4 md:right-0 top-1/2 -translate-y-1/2 md:translate-x-1/2 w-11 h-11 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-md border border-white/10 transition-all disabled:hover:bg-white/20 text-white text-lg md:text-xl shadow-lg"
                    >
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    {{-- Thumbnails --}}
                    <div class="flex gap-2 mt-6 overflow-x-auto pb-2 px-4 justify-start sm:justify-center">
                        <template x-for="(image, idx) in images" :key="idx">
                            <button 
                                @click="currentIndex = idx"
                                :class="{ 'ring-2 ring-white': currentIndex === idx }"
                                class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden opacity-70 hover:opacity-100 transition-opacity"
                            >
                                <img :src="image.src" :alt="image.caption" class="w-full h-full object-cover">
                            </button>
                        </template>
                    </div>
                </div>
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
                        <div class="flex items-start gap-4">
                            <svg class="w-5 h-5 mt-0.5 shrink-0 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-[#2D1B10]/70 break-words">{{ $locationSettings['address'] ?? 'Jl. KH Achmad Fauzan No.17, Krasak, Bangsri' }}</span>
                        </div>
                        <div class="flex items-start gap-4">
                            <svg class="w-5 h-5 mt-0.5 shrink-0 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[#2D1B10]/70 break-words">{{ $locationSettings['hours'] ?? 'Buka Setiap Hari: 07:00 - 21:00 WIB' }}</span>
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

<script>
    function galleryModal() {
        return {
            isOpen: false,
            currentIndex: 0,
            images: [
                @foreach($moments as $moment)
                    {
                        src: '{{ $moment->image }}',
                        caption: '{{ $moment->caption }}'
                    },
                @endforeach
            ],
            
            openModal(index) {
                if (this.images.length === 0) return;
                this.currentIndex = index;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },
            
            closeModal() {
                this.isOpen = false;
                document.body.style.overflow = '';
            },
            
            nextImage() {
                if (this.hasNext()) {
                    this.currentIndex++;
                }
            },
            
            prevImage() {
                if (this.hasPrev()) {
                    this.currentIndex--;
                }
            },
            
            hasNext() {
                return this.currentIndex < this.images.length - 1;
            },
            
            hasPrev() {
                return this.currentIndex > 0;
            },

            handleKeydown(event) {
                if (!this.isOpen) {
                    return;
                }

                if (event.key === 'ArrowRight') {
                    event.preventDefault();
                    this.nextImage();
                }

                if (event.key === 'ArrowLeft') {
                    event.preventDefault();
                    this.prevImage();
                }

                if (event.key === 'Escape') {
                    event.preventDefault();
                    this.closeModal();
                }
            }
        }
    }
</script>

@endsection
