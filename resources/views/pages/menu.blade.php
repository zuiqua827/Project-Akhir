@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $heroSettings['badge'] ?? 'Est. 2024' }}</span>
                <h1 class="text-5xl md:text-7xl font-serif leading-[1.1] mb-6 text-[#2D1B10]">
                    {{ $heroSettings['title'] ?? 'Racikan Kami' }} <span class="italic text-[#D4A373]">{{ $heroSettings['subtitle'] ?? 'Menu.' }}</span>
                </h1>
                <p class="text-lg md:text-xl text-[#2D1B10]/70 max-w-2xl mx-auto leading-relaxed">
                    {{ $heroSettings['description'] ?? 'Setiap cangkir diracik langsung oleh barista kami dengan teknik, suhu, dan takaran yang presisi untuk menghasilkan rasa terbaik.' }}
                </p>
            </div>
        </div>
    </section>

    {{-- Menu Categories --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            @foreach($categories as $category)
                <div class="mb-24 last:mb-0">
                    {{-- Category Title --}}
                    <div class="flex items-center gap-6 mb-12">
                        <div class="flex-1 h-px bg-[#2D1B10]/10"></div>
                        <h2 class="text-3xl md:text-4xl font-serif text-[#2D1B10]">{{ $category['name'] }}</h2>
                        <div class="flex-1 h-px bg-[#2D1B10]/10"></div>
                    </div>

                    {{-- Products Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($category['items'] as $item)
                            <a href="{{ route('menu.show', $item->id) }}" class="group block bg-[#FDFBF7] rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                                <div class="h-56 overflow-hidden relative">
                                    <img src="{{ $item->image }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $item->name }}">
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                        {{ $item->formatted_price }}
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-serif font-bold mb-2 group-hover:text-[#D4A373] transition-colors">{{ $item->name }}</h3>
                                    <p class="text-[#2D1B10]/50 text-sm leading-relaxed">{{ \Illuminate\Support\Str::limit($item->description ?? 'Belum ada penjelasan produk.', 95) }}</p>
                                    <p class="mt-3 text-xs font-semibold tracking-[0.15em] uppercase text-[#D4A373]">Lihat Penjelasan</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- {{-- CTA Section --}}
    <section class="py-24 bg-[#D4A373]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Bingung memilih? Mulai dari menu spesial kami.</h2>
            <p class="text-[#2D1B10] text-lg mb-10 opacity-80">Pilihan favorit barista kami di musim ini.</p>
            <div class="inline-block bg-[#2D1B10] text-[#FDFBF7] px-12 py-5 rounded-full font-bold text-2xl font-serif italic">
                Caramel Macadamia Latte - Rp 75.000
            </div>
        </div>
    </section> -->
@endsection
