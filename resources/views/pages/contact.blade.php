@extends('layouts.app')

@section('content')
@php
        $contactInfo = \App\Models\SiteSetting::getGroup('contact_info');
        
        $hoursJson = \App\Models\SiteSetting::get('contact_hours', 'hours_json', '[]');
        $hours = json_decode($hoursJson, true);

        $heroSettings = \App\Models\SiteSetting::getGroup('contact_hero');
        $reservationSettings = \App\Models\SiteSetting::getGroup('contact_reservation');

        $reservationEnabled = ($reservationSettings['enabled'] ?? '1') === '1';
        $reservationTitle = $reservationSettings['title'] ?? 'Reservasi';
        $reservationDescription = $reservationSettings['description'] ?? 'Jika Ingin Reservasi Bisa Hubungi Di Sini.';
        $reservationButtonText = $reservationSettings['button_text'] ?? 'Kirim ke WhatsApp';
        $reservationTemplateOpening = $reservationSettings['template_opening'] ?? 'Halo Admin, saya ingin reservasi dengan detail berikut:';
        $reservationTemplateClosing = $reservationSettings['template_closing'] ?? 'Mohon info ketersediaannya. Terima kasih.';
        $reservationSubjectOptions = json_decode($reservationSettings['subject_options_json'] ?? '[]', true);
        if (!is_array($reservationSubjectOptions) || empty($reservationSubjectOptions)) {
            $reservationSubjectOptions = [
                'Pertanyaan Umum',
                'Masukan',
                'Pemesanan Acara',
                'Kemitraan',
            ];
        }

        $waAdminRaw = $reservationSettings['whatsapp_number'] ?? $contactInfo['whatsapp'] ?? $contactInfo['phone'] ?? '';
        $waAdminNumber = preg_replace('/\D+/', '', $waAdminRaw);

        if (str_starts_with($waAdminNumber, '0')) {
            $waAdminNumber = '62' . substr($waAdminNumber, 1);
        } elseif (str_starts_with($waAdminNumber, '8')) {
            $waAdminNumber = '62' . $waAdminNumber;
        }
    @endphp

    {{-- Hero Section --}}
    <section class="relative pt-24 sm:pt-28 md:pt-32 pb-14 sm:pb-16 md:pb-20 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center">
                <span class="inline-block text-[#D4A373] font-bold uppercase tracking-[0.3em] text-xs mb-6">{{ $heroSettings['badge'] ?? 'Hubungi Kami' }}</span>
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-serif leading-[1.1] mb-5 sm:mb-6 text-[#2D1B10]">
                    {{ $heroSettings['title'] ?? 'Kunjungi' }} <span class="italic text-[#D4A373]">{{ $heroSettings['subtitle'] ?? 'Kami.' }}</span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-[#2D1B10]/70 max-w-2xl mx-auto leading-relaxed">
                    {{ $heroSettings['description'] ?? 'Kami senang mendengar dari Anda. Jika Anda punya pertanyaan tentang kopi kami, ingin memesan acara, atau sekadar menyapa, pintu kami selalu terbuka.' }}
                </p>
            </div>
        </div>
    </section>

    {{-- Contact Info & Form Section --}}
    <section class="py-16 sm:py-20 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 md:gap-16">
                {{-- Location & Hours --}}
                <div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-serif mb-8 sm:mb-10 md:mb-12 text-[#2D1B10]">Temukan Kami</h2>
                    
                    {{-- Alamat --}}
                    <div class="mb-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-[#D4A373]/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-[#2D1B10]">Alamat</h3>
                        </div>
                        <p class="text-[#2D1B10]/70 text-base sm:text-lg pl-0 sm:pl-16 break-words">{{ $contactInfo['address'] ?? '' }}</p>
                    </div>

                    {{-- Telepon --}}
                    <div class="mb-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-[#D4A373]/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-[#2D1B10]">Telepon</h3>
                        </div>
                        <p class="text-[#2D1B10]/70 text-base sm:text-lg pl-0 sm:pl-16 break-words">{{ $contactInfo['phone'] ?? '' }}</p>
                    </div>

                    {{-- Email --}}
                    <div class="mb-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-[#D4A373]/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-[#2D1B10]">Email</h3>
                        </div>
                        <p class="text-[#2D1B10]/70 text-base sm:text-lg pl-0 sm:pl-16 break-words">{{ $contactInfo['email'] ?? '' }}</p>
                    </div>

                    {{-- Hours --}}
                    <div class="mt-10 sm:mt-12 pt-10 sm:pt-12 border-t border-[#2D1B10]/10">
                        <h3 class="text-xl font-serif font-bold text-[#2D1B10] mb-6">Jam Operasional</h3>
                        <div class="space-y-4">
                            @foreach($hours as $hour)
                                <div class="flex justify-between items-center py-3 border-b border-[#2D1B10]/5">
                                    <span class="text-[#2D1B10]/70 text-sm sm:text-base">{{ $hour['day'] }}</span>
                                    <span class="font-medium text-[#2D1B10] text-sm sm:text-base text-right">{{ $hour['time'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

{{-- Map Preview Card --}}
                    <div class="mt-8">
                        <div class="relative rounded-2xl overflow-hidden shadow-xl h-64">
                            @php
                                $contactMapsQuery = $contactInfo['maps_query'] ?? 'Krasak, Bangsri, Jepara, Jawa Tengah';
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
                            <a href="https://www.google.com/maps/search/{{ urlencode($contactMapsQuery) }}" target="_blank" rel="noopener noreferrer" class="inline-flex w-full sm:w-auto justify-center items-center gap-3 px-6 py-4 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-xs hover:bg-[#4A2C1C] transition-all shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Lihat Rute
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="bg-[#FDFBF7] rounded-3xl p-6 sm:p-8 lg:p-12">
                    @if(session('error'))
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-serif mb-4 text-[#2D1B10]">{{ $reservationTitle }}</h2>
                    <p class="text-[#2D1B10]/60 mb-7 sm:mb-10">{{ $reservationDescription }}</p>

                    @if($reservationEnabled)
                        <form id="reservation-wa-form" action="{{ route('contact.reserve') }}" method="POST" class="space-y-6" data-wa-number="{{ $waAdminNumber }}" data-template-opening="{{ $reservationTemplateOpening }}" data-template-closing="{{ $reservationTemplateClosing }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Nama Depan</label>
                                    <input type="text" id="first_name" name="first_name" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" placeholder="Budi" required>
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Nama Belakang</label>
                                    <input type="text" id="last_name" name="last_name" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" placeholder="Santoso">
                                </div>
                            </div>
                            
                            {{-- <div>
                                <label for="email" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" placeholder="nama@email.com" required>
                            </div> --}}

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="reservation_date" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Tanggal Reservasi</label>
                                    <input type="date" id="reservation_date" name="reservation_date" min="{{ now()->toDateString() }}" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" required>
                                </div>
                                <div>
                                    <label for="reservation_time" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Waktu Reservasi</label>
                                    <input type="time" id="reservation_time" name="reservation_time" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" required>
                                </div>
                            </div>
                            
                            <div>
                                <label for="subject" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Subjek</label>
                                <select id="subject" name="subject" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors" required>
                                    <option value="">Pilih subjek</option>
                                    @foreach($reservationSubjectOptions as $subjectOption)
                                        <option value="{{ $subjectOption }}">{{ $subjectOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-bold uppercase tracking-widest text-[#2D1B10]/60 mb-3">Pesan</label>
                                <textarea id="message" name="message" rows="5" class="w-full px-6 py-4 bg-white border border-[#2D1B10]/10 rounded-xl focus:outline-none focus:border-[#D4A373] transition-colors resize-none" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>
                            
                            <button type="submit" class="w-full px-10 py-5 bg-[#2D1B10] text-white rounded-xl font-bold uppercase tracking-widest text-sm hover:bg-[#4A2C1C] transition-all">
                                {{ $reservationButtonText }}
                            </button>
                        </form>
                        <p class="text-xs text-[#2D1B10]/50 mt-4">Klik tombol untuk membuka WhatsApp dengan template reservasi otomatis.</p>
                    @else
                        <div class="rounded-xl border border-amber-300 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                            Form reservasi sedang dinonaktifkan oleh admin.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- {{-- CTA Section --}}
    {{-- <section class="py-24 bg-[#D4A373]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-serif text-[#2D1B10] mb-6">Tidak sabar menyambut Anda.</h2>
            <p class="text-[#2D1B10] text-lg mb-10 opacity-80">Mampir dan nikmati secangkir kopi spesialti kami hari ini.</p>
            <a href="{{ route('menu') }}" class="inline-block px-12 py-5 bg-[#2D1B10] text-white rounded-full font-bold uppercase tracking-widest text-sm hover:bg-[#FDFBF7] hover:text-[#2D1B10] transition-all">
                Lihat Menu
            </a>
        </div>
    </section> --}} -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('reservation-wa-form');
            if (!form) {
                return;
            }

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                if (!form.reportValidity()) {
                    return;
                }

                var waNumber = form.dataset.waNumber;
                if (!waNumber) {
                    alert('Nomor WhatsApp admin belum diatur.');
                    return;
                }

                var templateOpening = form.dataset.templateOpening || 'Halo Admin, saya ingin reservasi dengan detail berikut:';
                var templateClosing = form.dataset.templateClosing || 'Mohon info ketersediaannya. Terima kasih.';
                var firstNameField = form.querySelector('#first_name');
                var lastNameField = form.querySelector('#last_name');
                var reservationDateField = form.querySelector('#reservation_date');
                var reservationTimeField = form.querySelector('#reservation_time');
                var messageField = form.querySelector('#message');
                var firstName = firstNameField ? firstNameField.value.trim() : '';
                var lastName = lastNameField ? lastNameField.value.trim() : '';
                var fullName = [firstName, lastName].filter(Boolean).join(' ');
                var reservationDate = reservationDateField ? reservationDateField.value.trim() : '';
                var reservationTime = reservationTimeField ? reservationTimeField.value.trim() : '';
                var subjectField = form.querySelector('#subject');
                var subjectLabel = subjectField && subjectField.selectedOptions.length
                    ? subjectField.selectedOptions[0].text
                    : '-';
                var message = messageField ? messageField.value.trim() : '';

                var reservationDateLabel = '-';
                if (reservationDate) {
                    var dateParts = reservationDate.split('-');
                    reservationDateLabel = dateParts.length === 3
                        ? dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0]
                        : reservationDate;
                }

                var reservationTimeLabel = reservationTime ? reservationTime + ' WIB' : '-';

                var waTemplate = [
                    templateOpening,
                    '',
                    '- Nama: ' + (fullName || '-'),
                    //'- Email: ' + (email || '-'),
                    '- Tanggal Reservasi: ' + reservationDateLabel,
                    '- Waktu Reservasi: ' + reservationTimeLabel,
                    '- Subjek: ' + (subjectLabel || '-'),
                    '- Pesan: ' + (message || '-'),
                    '',
                    templateClosing
                ].join('\n');

                var waUrl = 'https://wa.me/' + waNumber + '?text=' + encodeURIComponent(waTemplate);
                var waWindow = window.open(waUrl, '_blank', 'noopener,noreferrer');

                if (!waWindow) {
                    window.location.href = waUrl;
                }
            });
        });
    </script>
@endsection
