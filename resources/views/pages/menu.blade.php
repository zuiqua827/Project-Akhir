@extends('layouts.app')

@section('content')
    @php
        use App\Models\Product;

        $categoryLabels = [
            'signature' => 'Signature Coffees',
            'specialty' => 'Specialty Drinks',
            'quick' => 'Quick Selections',
            'non-coffee' => 'Non-Coffee',
        ];

        $products = Product::query()
            ->where('is_available', true)
            ->orderBy('category')
            ->orderByDesc('is_featured')
            ->get();

        $categories = $products
            ->groupBy('category')
            ->map(function ($items, $category) use ($categoryLabels) {
                return [
                    'name' => $categoryLabels[$category] ?? str_replace('-', ' ', $category),
                    'items' => $items->map(function ($product) {
                        return [
                            'name' => $product->name,
                            'price' => '$' . number_format((float) $product->price, 2),
                            'desc' => $product->description,
                            'img' => $product->image,
                        ];
                    })->values(),
                ];
            })
            ->values();

        $heroSettings = \App\Models\SiteSetting::getGroup('menu_hero');
    @endphp

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $heroSettings['badge'] ?? 'Est. 2024' }}</span>
                <h1 class="text-5xl md:text-7xl font-serif leading-[1.1] mb-6 text-[#2D1B10]">
                    {{ $heroSettings['title'] ?? 'Our Craft' }} <span class="italic text-[#D4A373]">{{ $heroSettings['subtitle'] ?? 'Menu.' }}</span>
                </h1>
                <p class="text-lg md:text-xl text-[#2D1B10]/70 max-w-2xl mx-auto leading-relaxed">
                    {{ $heroSettings['description'] ?? 'Every cup is hand-crafted by our master baristas using precise temperatures and measurements for the ultimate flavor extraction.' }}
                </p>
            </div>
        </div>
    </section>

    {{-- Menu Categories --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            @foreach($categories as $index => $category)
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
                            <div class="group bg-[#FDFBF7] rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                                <div class="h-56 overflow-hidden relative">
                                    <img src="{{ $item['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $item['name'] }}">
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                        {{ $item['price'] }}
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-serif font-bold mb-2 group-hover:text-[#D4A373] transition-colors">{{ $item['name'] }}</h3>
                                    <p class="text-[#2D1B10]/50 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- {{-- CTA Section --}}
    <section class="py-24 bg-[#D4A373]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Can't decide? Start with our special.</h2>
            <p class="text-[#2D1B10] text-lg mb-10 opacity-80">Our master barista's personal favorite this season.</p>
            <div class="inline-block bg-[#2D1B10] text-[#FDFBF7] px-12 py-5 rounded-full font-bold text-2xl font-serif italic">
                Caramel Macadamia Latte — $7.50
            </div>
        </div>
    </section> -->
@endsection
