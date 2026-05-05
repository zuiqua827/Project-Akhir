@extends('layouts.app')

@section('content')
@php
    $values = [
        ['icon' => '☕', 'title' => 'Quality First', 'desc' => 'We source only the finest single-origin beans from ethical farms worldwide.'],
        ['icon' => '🌱', 'title' => 'Sustainability', 'desc' => 'Every step of our process is designed to minimize environmental impact.'],
        ['icon' => '❤️', 'title' => 'Community', 'desc' => 'We believe coffee is a catalyst for meaningful connections and conversations.'],
        ['icon' => '✨', 'title' => 'Craftmanship', 'desc' => 'Our baristas are trained for months to perfect every cup they serve.'],
    ];

    $timeline = [
        ['year' => '2024', 'title' => 'A New Beginning', 'desc' => 'Café opens its doors, bringing specialty coffee to the heart of Jakarta.'],
        ['year' => 'Q2 2024', 'title' => 'Growing Family', 'desc' => 'We launch our loyalty program and welcome over 10,000 happy customers.'],
        ['year' => 'Q3 2024', 'title' => 'Direct Trade', 'desc' => 'Established direct partnerships with coffee farmers in Sumatra and Java.'],
        ['year' => 'Q4 2024', 'title' => 'Recognition', 'desc' => 'Awarded Best Specialty Coffee Shop in Jakarta by local food critics.'],
    ];
@endphp

{{-- Hero Section --}}
<section class="relative pt-32 pb-20 bg-[#FDFBF7]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">our story</span>
                <h1 class="text-5xl md:text-7xl font-serif leading-[1.1] mb-8 text-[#2D1B10]">
                    Beyond just <span class="italic text-[#D4A373]">Coffee.</span>
                </h1>
                <p class="text-lg text-[#2D1B10]/70 mb-6 leading-relaxed">
                    At Café, we believe that coffee is a ritual, not just a drink. Our beans are ethically sourced from the highest altitudes and roasted in small batches to preserve their unique profiles.
                </p>
                <p class="text-lg text-[#2D1B10]/70 mb-10 leading-relaxed">
                    Whether you're seeking a quiet corner for reflection or a vibrant space for connection, our doors are open to provide a sanctuary of warmth and exceptional taste.
                </p>
                <div class="grid grid-cols-2 gap-8 border-t border-[#2D1B10]/10 pt-10">
                    <div>
                        <h4 class="font-serif text-4xl mb-2 text-[#D4A373]">100%</h4>
                        <p class="text-xs uppercase tracking-widest text-[#2D1B10]/60 font-bold">Organic Beans</p>
                    </div>
                    <div>
                        <h4 class="font-serif text-4xl mb-2 text-[#D4A373]">15+</h4>
                        <p class="text-xs uppercase tracking-widest text-[#2D1B10]/60 font-bold">Countries Sourced</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Brewing coffee">
                </div>
                <div class="absolute -bottom-10 -left-10 hidden md:block w-72 aspect-square rounded-3xl overflow-hidden border-8 border-white shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1507133750040-4a8f57021571?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover" alt="Coffee cup">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values Section --}}
<section class="py-24 bg-[#2D1B10]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-serif text-[#FDFBF7] mb-6">What Drives Us</h2>
            <p class="text-[#FDFBF7]/60 max-w-2xl mx-auto">Our principles guide every decision we make, from bean to cup.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
@foreach($values as $value)
            <div class="text-center p-8 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:border-[#D4A373]/30 transition-all duration-500">
                <div class="text-5xl mb-6">{{ $value['icon'] }}</div>
                <h3 class="text-xl font-serif font-bold text-[#FDFBF7] mb-4">{{ $value['title'] }}</h3>
                <p class="text-[#FDFBF7]/50 text-sm leading-relaxed">{{ $value['desc'] }}</p>
            </div>
@endforeach
        </div>
    </div>
</section>

{{-- Story Timeline --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-16">
            <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">our journey</span>
            <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10]">The Story</h2>
        </div>
        <div class="relative">
            {{-- Timeline Line --}}
            <div class="absolute left-1/2 top-0 bottom-0 w-px bg-[#2D1B10]/10 hidden md:block transform -translate-x-1/2"></div>
            
            <div class="space-y-16">
@foreach($timeline as $index => $item)
                <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-center">
                    <div class="{{ $index % 2 === 0 ? 'md:text-right md:pr-16' : 'md:order-2 md:pl-16' }}">
                        <div class="inline-block">
                            <span class="text-6xl font-serif text-[#D4A373]/20 font-bold">{{ $item['year'] }}</span>
                        </div>
                    </div>
                    <div class="{{ $index % 2 === 0 ? 'md:order-2 md:pl-16' : 'md:text-right md:pr-16' }}">
                        <h3 class="text-2xl font-serif font-bold text-[#2D1B10] mb-3">{{ $item['title'] }}</h3>
                        <p class="text-[#2D1B10]/60 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                    {{-- Timeline Dot --}}
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-[#D4A373] rounded-full hidden md:block ring-4 ring-white"></div>
                </div>
@endforeach
            </div>
        </div>
    </div>
</section>

{{-- Team Section --}}
<section class="py-24 bg-[#FDFBF7]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-16">
            <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">our people</span>
            <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Meet the Team</h2>
            <p class="text-[#2D1B10]/60 max-w-2xl mx-auto">The passionate minds behind every perfect cup.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group text-center">
                <div class="aspect-[3/4] rounded-3xl overflow-hidden mb-6 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Barista">
                </div>
                <h3 class="text-xl font-serif font-bold text-[#2D1B10] mb-1">Sarah Mitchell</h3>
                <p class="text-[#D4A373] text-sm font-bold uppercase tracking-widest">Head Barista</p>
            </div>
            <div class="group text-center">
                <div class="aspect-[3/4] rounded-3xl overflow-hidden mb-6 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1556157382-97edd2f9e4c7?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Roaster">
                </div>
                <h3 class="text-xl font-serif font-bold text-[#2D1B10] mb-1">James Chen</h3>
                <p class="text-[#D4A373] text-sm font-bold uppercase tracking-widest">Master Roaster</p>
            </div>
            <div class="group text-center">
                <div class="aspect-[3/4] rounded-3xl overflow-hidden mb-6 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Owner">
                </div>
                <h3 class="text-xl font-serif font-bold text-[#2D1B10] mb-1">Emma Laurent</h3>
                <p class="text-[#D4A373] text-sm font-bold uppercase tracking-widest">Founder</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-24 bg-[#D4A373]">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Come visit us today.</h2>
        <p class="text-[#2D1B10] text-lg mb-10 opacity-80">Experience the difference in person.</p>
        <a href="{{ route('contact') }}" class="inline-block px-12 py-5 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-sm hover:bg-[#FDFBF7] hover:text-[#2D1B10] transition-all">
            Get Directions
        </a>
    </div>
</section>
@endsection
