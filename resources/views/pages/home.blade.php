@extends('layouts.app')

@section('content')
@php
    use App\Models\Product;

    $products = Product::where('is_featured', true)->take(4)->get();
    $pricing = Product::where('is_available', true)->limit(6)->get();
    $special = Product::where('is_special', true)->first();

    $moments = App\Models\Moment::ordered()->get();

    $testimonials = [
        ['name' => 'Amanda Sari', 'text' => 'The best coffee in Jepara! The atmosphere is perfect for working or catching up with friends. My go-to spot.', 'rating' => 5, 'img' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=150'],
        ['name' => 'Budi Santoso', 'text' => 'Amazing latte art and the staff is incredibly skilled. Been coming here every weekend for months.', 'rating' => 5, 'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=150'],
        ['name' => 'Diana Permata', 'text' => 'Such a cozy place! The Caramel Macadamia Latte is to die for. Highly recommended.', 'rating' => 5, 'img' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=150'],
    ];
@endphp

    {{-- Hero Section --}}
    <section id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-[#FDFBF7] via-[#FDFBF7]/80 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="Cafe interior">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-20">
            <div class="max-w-2xl">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">Est. 2024</span>
                <h1 class="text-6xl md:text-8xl font-serif leading-[1.1] mb-8 text-[#2D1B10]">
                    Freshly Brewed <br><span class="italic text-[#D4A373]">For You.</span>
                </h1>
                <p class="text-lg md:text-xl text-[#2D1B10]/70 mb-6 leading-relaxed max-w-lg">
                    Experience the perfect balance of artisan roasting and soulful atmosphere in every single cup we serve.
                </p>
                <p class="text-[#2D1B10]/50 mb-12 text-sm">
                    Ethically sourced beans, roasted in small batches.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                    <a href="{{ route('menu') }}" class="px-10 py-5 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-xs hover:bg-[#4A2C1C] transition-all shadow-xl shadow-[#2D1B10]/20">
                        Explore Menu
                    </a>
                    <a href="{{ route('about') }}" class="px-10 py-5 border border-[#2D1B10] text-[#2D1B10] rounded-full font-bold uppercase tracking-widest text-xs hover:bg-[#2D1B10] hover:text-white transition-all">
                        Our Story
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Product Section (Featured) --}}
    <section id="menu" class="py-32 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-5xl font-serif mb-6">Featured Drinks</h2>
                <div class="w-20 h-1 bg-[#D4A373] mx-auto mb-8"></div>
                <p class="text-[#2D1B10]/60">Hand-crafted by our master baristas.</p>
            </div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="h-64 overflow-hidden relative">
                            <img src="{{ $product->image }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $product->name }}">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full font-bold text-sm">
                                ${{ number_format($product->price, 2) }}
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-xl font-serif font-bold mb-3 group-hover:text-[#D4A373] transition-colors">{{ $product->name }}</h3>
                            <p class="text-[#2D1B10]/50 text-sm leading-relaxed">{{ $product->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

{{-- Best Sellers --}}
    <section class="py-32 bg-[#2D1B10] text-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <div>
                    <h2 class="text-5xl font-serif mb-12">Best <span class="text-[#D4A373]">Sellers</span></h2>
                    <div class="space-y-8">
                        @foreach($pricing as $item)
                            <div class="flex justify-between items-end border-b border-white/10 pb-4 group cursor-default">
                                <div>
                                    <h4 class="text-xl font-medium group-hover:text-[#D4A373] transition-colors">{{ $item->name }}</h4>
                                    <p class="text-xs text-white/40 uppercase tracking-widest mt-1">Premium Roast</p>
                                </div>
                                <div class="text-xl font-serif italic text-[#D4A373]">${{ number_format($item->price, 2) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center justify-center lg:pl-12">
                    @if($special)
                    <div class="text-center p-16 border border-white/10 rounded-3xl bg-white/5 backdrop-blur-sm">
                        <h3 class="text-2xl font-serif mb-6 italic">Today's Special</h3>
                        <p class="text-4xl font-serif mb-8 text-[#D4A373]">{{ $special->name }}</p>
                        <p class="text-white/60 mb-10 leading-relaxed">{{ $special->description }}</p>
                        <span class="text-5xl font-serif">${{ number_format($special->price, 2) }}</span>
                    </div>
                    @else
                    <div class="text-center p-16 border border-white/10 rounded-3xl bg-white/5 backdrop-blur-sm">
                        <h3 class="text-2xl font-serif mb-6 italic">Today's Special</h3>
                        <p class="text-4xl font-serif mb-8 text-[#D4A373]">Caramel Macadamia Latte</p>
                        <p class="text-white/60 mb-10 leading-relaxed">Topped with crushed roasted macadamia and house-made salted caramel.</p>
                        <span class="text-5xl font-serif">$7.50</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Section (Instagram-style) --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">Our Moments</span>
                <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10]">Gallery</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($moments as $index => $moment)
                    <div class="group relative aspect-square overflow-hidden rounded-2xl" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <img src="{{ $moment->image }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $moment->caption }}">
                        <div class="absolute inset-0 bg-[#2D1B10]/60 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <span class="text-white font-serif text-lg">{{ $moment->caption }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <p>Gallery coming soon...</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-24 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">What They Say</span>
                <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10]">Testimonials</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $index => $testimonial)
                    <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 0; $i < $testimonial['rating']; $i++)
                                <svg class="w-5 h-5 text-[#D4A373]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p class="text-[#2D1B10]/70 mb-6 leading-relaxed">"{{ $testimonial['text'] }}"</p>
                        <div class="flex items-center gap-4">
                            <img src="{{ $testimonial['img'] }}" class="w-12 h-12 rounded-full object-cover" alt="{{ $testimonial['name'] }}">
                            <div>
                                <h4 class="font-serif font-bold text-[#2D1B10]">{{ $testimonial['name'] }}</h4>
                                <p class="text-xs text-[#2D1B10]/50 uppercase tracking-widest">Customer</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Location --}}
    <section id="location" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">Visit Us</span>
                    <h2 class="text-4xl md:text-5xl font-serif mb-6 leading-tight">Find Your <span class="italic text-[#D4A373]">Sanctuary.</span></h2>
                    <p class="text-[#2D1B10]/60 mb-8 text-lg">
                        Located in the heart of Jepara, our café offers a warm atmosphere perfect for work, relaxation, or catching up with friends.
                    </p>
                    <div class="space-y-4 mb-10">
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-[#2D1B10]/70">Jl. KH Achmad Fauzan No.17, Krasak, Bangsri</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[#2D1B10]/70">Open Daily: 07:00 - 21:00 WIB</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-xs hover:bg-[#4A2C1C] transition-all">
                        Get Directions
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                <div class="rounded-2xl overflow-hidden shadow-2xl h-80 lg:h-96">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.016263254858!2d110.71162437368348!3d-6.540762993376128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7d18b2cf9b8a1f%3A0xd8d68ac63c1d6b8e!2sKrasak%2C%20Bangsri%2C%20Jepara%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
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

    {{-- CTA Section --}}
    <section class="py-32 bg-[#D4A373]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-5xl md:text-6xl font-serif text-[#2D1B10] mb-10">Ready to taste the difference?</h2>
            <p class="text-[#2D1B10] text-lg mb-12 opacity-80 uppercase tracking-widest font-bold">Join us for your perfect cup</p>
            <a href="{{ route('menu') }}" class="inline-block px-12 py-6 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-sm hover:bg-[#FDFBF7] hover:text-[#2D1B10] transition-all">
                View Menu
            </a>
        </div>
    </section>
@endsection
