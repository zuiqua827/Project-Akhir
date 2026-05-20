@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-24 sm:pt-28 md:pt-32 pb-14 sm:pb-16 md:pb-20 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $heroSettings['badge'] ?? 'Est. 2024' }}</span>
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-serif leading-[1.1] mb-5 sm:mb-6 text-[#2D1B10]">
                    {{ $heroSettings['title'] ?? 'Racikan Kami' }} <span class="italic text-[#D4A373]">{{ $heroSettings['subtitle'] ?? 'Menu.' }}</span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-[#2D1B10]/70 max-w-2xl mx-auto leading-relaxed">
                    {{ $heroSettings['description'] ?? 'Setiap cangkir diracik langsung oleh barista kami dengan teknik, suhu, dan takaran yang presisi untuk menghasilkan rasa terbaik.' }}
                </p>
            </div>
        </div>
    </section>

    {{-- Menu Categories --}}
    <section class="py-14 sm:py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            @php
                $matchedItems = $categories->sum(fn ($category) => $category['items']->count());
                $hasFilters = $keyword !== '' || $selectedCategory !== '' || ($isAllCategoryView && $showAllItems);
            @endphp

            <div class="mb-10 sm:mb-12">
                <form action="{{ route('menu') }}" method="GET" class="flex flex-col sm:flex-row gap-3 sm:items-center">
                    @if($selectedCategory !== '')
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif
                    @if($isAllCategoryView && $showAllItems)
                        <input type="hidden" name="show" value="all">
                    @endif
                    <div class="relative flex-1">
                        <span class="pointer-events-none absolute inset-y-0 left-0 pl-4 flex items-center text-[#2D1B10]/45">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"></path>
                            </svg>
                        </span>
                        <input
                            type="text"
                            name="q"
                            value="{{ $keyword }}"
                            placeholder="Cari menu favorit kamu..."
                            class="w-full rounded-2xl border border-[#2D1B10]/15 bg-[#FDFBF7] pl-11 pr-4 py-3 text-sm text-[#2D1B10] focus:outline-none focus:ring-2 focus:ring-[#D4A373] focus:border-[#D4A373]"
                        >
                    </div>
                    <div class="flex w-full sm:w-auto gap-2">
                        <button type="submit" class="inline-flex flex-1 sm:flex-none justify-center items-center px-6 py-3 rounded-2xl bg-[#2D1B10] text-white font-semibold hover:bg-[#4A2C1C] transition-colors">
                            Cari
                        </button>
                        @if($hasFilters)
                            <a href="{{ route('menu') }}" class="inline-flex flex-1 sm:flex-none justify-center items-center px-6 py-3 rounded-2xl border border-[#2D1B10]/20 text-[#2D1B10] font-semibold hover:bg-[#FDFBF7] transition-colors">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                @if($availableCategories->isNotEmpty())
                    <div class="mt-4 flex flex-wrap gap-2">
                        <a
                            href="{{ route('menu', array_filter(['q' => $keyword], fn ($value) => $value !== '')) }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold border transition-colors {{ $selectedCategory === '' ? 'bg-[#2D1B10] border-[#2D1B10] text-white' : 'bg-white border-[#2D1B10]/20 text-[#2D1B10] hover:bg-[#FDFBF7]' }}"
                        >
                            Semua
                        </a>
                        @foreach($availableCategories as $filterCategory)
                            <a
                                href="{{ route('menu', array_filter(['q' => $keyword, 'category' => $filterCategory->slug], fn ($value) => $value !== '')) }}"
                                class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold border transition-colors {{ $selectedCategory === $filterCategory->slug ? 'bg-[#2D1B10] border-[#2D1B10] text-white' : 'bg-white border-[#2D1B10]/20 text-[#2D1B10] hover:bg-[#FDFBF7]' }}"
                            >
                                {{ $filterCategory->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                @if($hasFilters)
                    <p class="mt-3 text-sm text-[#2D1B10]/65">
                        Menampilkan
                        @if($isAllCategoryView && $isLimitedAllCategory)
                            {{ $matchedItems }} dari {{ $allCategoryTotalItems }}
                        @else
                            {{ $matchedItems }}
                        @endif
                        menu
                        @if($keyword !== '')
                            untuk kata kunci <span class="font-semibold text-[#2D1B10]">"{{ $keyword }}"</span>
                        @endif
                        @if($selectedCategoryName !== '')
                            pada kategori <span class="font-semibold text-[#2D1B10]">{{ $selectedCategoryName }}</span>
                        @endif
                        .
                    </p>
                @endif
            </div>

            @if($isAllCategoryView)
                @php
                    $allItems = $categories->first()['items'] ?? collect();
                @endphp

                @if($allItems->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-7 md:gap-8">
                        @foreach($allItems as $item)
                            <a href="{{ route('menu.show', $item->slug) }}" class="group block bg-[#FDFBF7] rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                                <div class="h-52 sm:h-56 overflow-hidden relative">
                                    <img src="{{ $item->image }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $item->name }}">
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                        {{ $item->formatted_price }}
                                    </div>
                                </div>
                                <div class="p-5 sm:p-6">
                                    <h3 class="text-lg font-serif font-bold mb-2 break-words group-hover:text-[#D4A373] transition-colors">{{ $item->name }}</h3>
                                    <p class="text-[#2D1B10]/50 text-sm leading-relaxed break-words">{{ \Illuminate\Support\Str::limit($item->description ?? 'Belum ada penjelasan produk.', 95) }}</p>
                                    <p class="mt-3 text-xs font-semibold tracking-[0.15em] uppercase text-[#D4A373]">Lihat Penjelasan</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if($isLimitedAllCategory)
                        <div class="mt-8 sm:mt-10 text-center">
                            <a
                                href="{{ route('menu', array_filter(['q' => $keyword, 'show' => 'all'], fn ($value) => $value !== '')) }}"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-[#2D1B10]/20 text-[#2D1B10] text-sm font-semibold tracking-[0.08em] uppercase hover:bg-[#2D1B10] hover:text-white hover:border-[#2D1B10] transition-all"
                            >
                                Lihat Semua
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-16">
                        @if($hasFilters)
                            <p class="text-[#2D1B10]/55 text-lg">Tidak ada menu yang cocok dengan filter yang kamu pilih.</p>
                            <a href="{{ route('menu') }}" class="inline-flex mt-4 px-5 py-2.5 rounded-full border border-[#2D1B10]/20 text-[#2D1B10] text-sm font-semibold hover:bg-[#FDFBF7] transition-colors">
                                Lihat Semua Menu
                            </a>
                        @else
                            <p class="text-[#2D1B10]/45 text-lg">Menu belum tersedia saat ini.</p>
                        @endif
                    </div>
                @endif
            @else
                @forelse($categories as $category)
                    <div class="mb-14 sm:mb-16 md:mb-24 last:mb-0">
                        <div class="flex items-center gap-4 sm:gap-6 mb-8 sm:mb-10 md:mb-12">
                            <div class="flex-1 h-px bg-[#2D1B10]/10"></div>
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-serif text-[#2D1B10] text-center">{{ $category['name'] }}</h2>
                            <div class="flex-1 h-px bg-[#2D1B10]/10"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-7 md:gap-8">
                            @foreach($category['items'] as $item)
                                <a href="{{ route('menu.show', $item->slug) }}" class="group block bg-[#FDFBF7] rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                                    <div class="h-52 sm:h-56 overflow-hidden relative">
                                        <img src="{{ $item->image }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $item->name }}">
                                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                            {{ $item->formatted_price }}
                                        </div>
                                    </div>
                                    <div class="p-5 sm:p-6">
                                        <h3 class="text-lg font-serif font-bold mb-2 break-words group-hover:text-[#D4A373] transition-colors">{{ $item->name }}</h3>
                                        <p class="text-[#2D1B10]/50 text-sm leading-relaxed break-words">{{ \Illuminate\Support\Str::limit($item->description ?? 'Belum ada penjelasan produk.', 95) }}</p>
                                        <p class="mt-3 text-xs font-semibold tracking-[0.15em] uppercase text-[#D4A373]">Lihat Penjelasan</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <p class="text-[#2D1B10]/55 text-lg">Tidak ada menu yang cocok dengan filter yang kamu pilih.</p>
                        <a href="{{ route('menu') }}" class="inline-flex mt-4 px-5 py-2.5 rounded-full border border-[#2D1B10]/20 text-[#2D1B10] text-sm font-semibold hover:bg-[#FDFBF7] transition-colors">
                            Lihat Semua Menu
                        </a>
                    </div>
                @endforelse
            @endif
        </div>
    </section>
@endsection
