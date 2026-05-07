@extends('layouts.app')

@section('content')
@php
        $contactInfo = \App\Models\SiteSetting::getGroup('contact_info');
        
        $hoursJson = \App\Models\SiteSetting::get('contact_hours', 'hours_json', '[]');
        $hours = json_decode($hoursJson, true);

        $heroSettings = \App\Models\SiteSetting::getGroup('contact_hero');
    @endphp

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $heroSettings['badge'] ?? 'Get in Touch' }}</span>
                <h1 class="text-5xl md:text-7xl font-serif leading-[1.1] mb-6 text-[#2D1B10]">
                    {{ $heroSettings['title'] ?? 'Visit' }} <span class="italic text-[#D4A373]">{{ $heroSettings['subtitle'] ?? 'Us.' }}</span>
                </h1>
                <p class="text-lg md:text-xl text-[#2D1B10]/70 max-w-2xl mx-auto leading-relaxed">
                    {{ $heroSettings['description'] ?? 'We\'d love to hear from you. Whether you have a question about our beans, want to book an event, or just want to say hello, our door is always open.' }}
                </p>
            </div>
        </div>
    </section>

    {{-- Contact Info & Form Section --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                {{-- Location & Hours --}}
                <div>
                    <h2 class="text-3xl md:text-4xl font-serif mb-12 text-[#2D1B10]">Find Us</h2>
                    
                    {{-- Address --}}
                    <div class="mb-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-[#D4A373]/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-[#2D1B10]">Address</h3>
                        </div>
                        <p class="text-[#2D1B10]/70 text-lg pl-16">{{ $contactInfo['address'] ?? '' }}</p>
                    </div>

                    {{-- Phone --}}
                    <div class="mb-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-[#D4A373]/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-[#2D1B10]">Phone</h3>
                        </div>
                        <p class="text-[#2D1B10]/70 text-lg pl-16">{{ $contactInfo['phone'] ?? '' }}</p>
                    </div>

                    {{-- Email --}}
                    <div class="mb-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-[#D4A373]/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-[#2D1B10]">Email</h3>
                        </div>
                        <p class="text-[#2D1B10]/70 text-lg pl-16">{{ $contactInfo['email'] ?? '' }}</p>
                    </div>

                    {{-- Hours --}}
                    <div class="mt-12 pt-12 border-t border-[#2D1B10]/10">
                        <h3 class="text-xl font-serif font-bold text-[#2D1B10] mb-6">Opening Hours</h3>
                        <div class="space-y-4">
                            @foreach($hours as $hour)
                                <div class="flex justify-between items-center py-3 border-b border-[#2D1B10]/5">
                                    <span class="text-[#2D1B10]/70">{{ $hour['day'] }}</span>
                                    <span class="font-medium text-[#2D1B10]">{{ $hour['time'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

{{-- Map Preview Card --}}
                    <div class="mt-8">
                        <div class="relative rounded-2xl overflow-hidden shadow-xl h-64">
                            @php
                                $contactMapsQuery = $contactInfo['maps_query'] ?? 'Krasak, Bangsri, Jepara, Central Java';
                                $contactMapsUrl = 'https://maps.google.com/maps?q=' . urlencode($contactMapsQuery) . '&output=embed';
                            @endphp
                            <iframe 
                                src="{{ $contactMapsUrl }}" 
                                width="100%" 
                                height="100%" 
                                style="border:0; filter: grayscale(100%) saturate(0);" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            <div class="absolute inset-0 bg-[#2D1B10]/10 pointer-events-none"></div>
                        </div>
                        <div class="mt-4">
                            <a href="https://www.google.com/maps/search/{{ urlencode($contactMapsQuery) }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-4 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-xs hover:bg-[#4A2C1C] transition-all shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Get Directions
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="bg-[#FDFBF7] rounded-3xl p-10 lg:p-12">
                    <h2 class="text-3xl md:text-4xl font-serif mb-4 text-[#2D1B10]">Send a Message</h2>
                    <p class="text-[#2D1B10]/60 mb-10">Have a question or feedback? We'd love to hear from you.</p>
                    
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" placeholder="John">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" placeholder="Doe">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" placeholder="john@example.com">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Subject</label>
                            <select id="subject" name="subject" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors">
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="feedback">Feedback</option>
                                <option value="event">Event Booking</option>
                                <option value="partnership">Partnership</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors resize-none" placeholder="Your message here..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full px-10 py-5 bg-[#2D1B10] text-white rounded-xl font-bold uppercase tracking-widest text-sm hover:bg-[#4A2C1C] transition-all">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    {{-- <section class="py-24 bg-[#D4A373]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Can't wait to see you.</h2>
            <p class="text-[#2D1B10] text-lg mb-10 opacity-80">Stop by for a cup of our specialty coffee today.</p>
            <a href="{{ route('menu') }}" class="inline-block px-12 py-5 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-sm hover:bg-[#FDFBF7] hover:text-[#2D1B10] transition-all">
                View Menu
            </a>
        </div>
    </section> --}}
@endsection
