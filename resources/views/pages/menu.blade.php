@extends('layouts.app')

@section('content')
    @php
        $categories = [
            [
                'name' => 'Signature Coffees',
                'items' => [
                    ['name' => 'Signature Espresso', 'price' => '$4.50', 'desc' => 'Rich, dark, and smooth with a caramel finish.', 'img' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Velvet Latte', 'price' => '$5.50', 'desc' => 'Creamy steamed milk poured over double espresso.', 'img' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Cloud Cappuccino', 'price' => '$5.00', 'desc' => 'Traditional balance of espresso, milk, and deep foam.', 'img' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Cold Brew Nitro', 'price' => '$6.00', 'desc' => 'Slow-steeped for 24 hours, infused with nitrogen.', 'img' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&q=80&w=600'],
                ]
            ],
            [
                'name' => 'Specialty Drinks',
                'items' => [
                    ['name' => 'Caramel Macadamia Latte', 'price' => '$7.50', 'desc' => 'House-made salted caramel with crushed roasted macadamia.', 'img' => 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Matcha Latte', 'price' => '$5.50', 'desc' => 'Premium Japanese matcha blended with steamed milk.', 'img' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Mocha Blend', 'price' => '$6.00', 'desc' => 'Rich chocolate ganache meets bold espresso.', 'img' => 'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Flat White', 'price' => '$5.25', 'desc' => 'Smooth espresso with velvety microfoam.', 'img' => 'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f?auto=format&fit=crop&q=80&w=600'],
                ]
            ],
            [
                'name' => 'Quick Selections',
                'items' => [
                    ['name' => 'Affogato', 'price' => '$7.00', 'desc' => 'Espresso poured over vanilla gelato.', 'img' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Macchiato', 'price' => '$4.00', 'desc' => 'Espresso with a splash of milk.', 'img' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Americano', 'price' => '$3.50', 'desc' => 'Rich espresso diluted with hot water.', 'img' => 'https://images.unsplash.com/photo-1510707577719-ae7c16805a38?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Espresso', 'price' => '$3.00', 'desc' => 'Single or double shot of our signature blend.', 'img' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&q=80&w=600'],
                ]
            ],
            [
                'name' => 'Non-Coffee',
                'items' => [
                    ['name' => 'Artisan Tea', 'price' => '$4.50', 'desc' => 'Premium loose-leaf tea selection.', 'img' => 'https://images.unsplash.com/photo-1597318181409-cf64d0b5d8a2?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Hot Chocolate', 'price' => '$5.00', 'desc' => 'Belgian chocolate melted into steamed milk.', 'img' => 'https://images.unsplash.com/photo-1542993243-a7c68aaf5b48?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Chai Latte', 'price' => '$5.25', 'desc' => 'Spiced chai blended with milk.', 'img' => 'https://images.unsplash.com/photo-1542665189-3bf51f0a6241?auto=format&fit=crop&q=80&w=600'],
                    ['name' => 'Fresh Juice', 'price' => '$6.00', 'desc' => 'Seasonal fruits, freshly pressed.', 'img' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?auto=format&fit=crop&q=80&w=600'],
                ]
            ]
        ];
    @endphp

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">Est. 2024</span>
                <h1 class="text-5xl md:text-7xl font-serif leading-[1.1] mb-6 text-[#2D1B10]">
                    Our Craft <span class="italic text-[#D4A373]">Menu.</span>
                </h1>
                <p class="text-lg md:text-xl text-[#2D1B10]/70 max-w-2xl mx-auto leading-relaxed">
                    Every cup is hand-crafted by our master baristas using precise temperatures and measurements for the ultimate flavor extraction.
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

    {{-- CTA Section --}}
    <section class="py-24 bg-[#D4A373]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Can't decide? Start with our special.</h2>
            <p class="text-[#2D1B10] text-lg mb-10 opacity-80">Our master barista's personal favorite this season.</p>
            <div class="inline-block bg-[#2D1B10] text-[#FDFBF7] px-12 py-5 rounded-full font-bold text-2xl font-serif italic">
                Caramel Macadamia Latte — $7.50
            </div>
        </div>
    </section>
@endsection
