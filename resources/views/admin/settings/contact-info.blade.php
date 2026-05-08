@extends('layouts.admin')

@section('content')
<div class="p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Info Kontak & Jam Operasional</h1>
            <p class="text-gray-500 mt-1">Atur alamat, detail kontak, dan jam operasional.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <form action="{{ route('admin.settings.contact.info') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold border-b pb-2">Detail Kontak</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                <textarea name="address" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['address'] ?? '' }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                    <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Tempat / Alamat di Google Maps</label>
                <input type="text" name="maps_query" value="{{ $settings['maps_query'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: SMK N 1 BANGSRI">
                <p class="text-xs text-gray-500 mt-1">Ketik nama tempat atau alamat lengkap. Peta akan otomatis menampilkan lokasi tersebut.</p>

                @php
                    $mapsQuery = $settings['maps_query'] ?? '';
                @endphp
                @if(!empty($mapsQuery))
                    <div class="mt-4 rounded-xl overflow-hidden h-48 border border-gray-200">
                        <iframe src="https://maps.google.com/maps?q={{ urlencode($mapsQuery) }}&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                @endif
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-6">Pengaturan Reservasi WhatsApp</h3>

            @php
                $reservationEnabled = old('reservation_enabled', $reservationSettings['enabled'] ?? '1');
            @endphp

            <div class="flex items-center gap-3">
                <input type="hidden" name="reservation_enabled" value="0">
                <input type="checkbox" id="reservation_enabled" name="reservation_enabled" value="1" @checked((string) $reservationEnabled === '1') class="w-4 h-4 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                <label for="reservation_enabled" class="text-sm font-medium text-gray-700">Aktifkan Form Reservasi di Halaman Kontak</label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp Admin</label>
                    <input type="text" name="reservation_whatsapp" value="{{ old('reservation_whatsapp', $reservationSettings['whatsapp_number'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="+62 822-2300-5860">
                    <p class="text-xs text-gray-500 mt-1">Nomor ini khusus tujuan reservasi WhatsApp.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Tombol</label>
                    <input type="text" name="reservation_button_text" value="{{ old('reservation_button_text', $reservationSettings['button_text'] ?? 'Kirim ke WhatsApp') }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="Kirim ke WhatsApp">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Form Reservasi</label>
                <input type="text" name="reservation_title" value="{{ old('reservation_title', $reservationSettings['title'] ?? 'Reservasi') }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="Reservasi">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Form Reservasi</label>
                <textarea name="reservation_description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="Jika ingin reservasi bisa hubungi di sini.">{{ old('reservation_description', $reservationSettings['description'] ?? 'Jika Ingin Reservasi Bisa Hubungi Di Sini.') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Template Pembuka Pesan WA</label>
                <textarea name="reservation_template_opening" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="Halo Admin, saya ingin reservasi dengan detail berikut:">{{ old('reservation_template_opening', $reservationSettings['template_opening'] ?? 'Halo Admin, saya ingin reservasi dengan detail berikut:') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Template Penutup Pesan WA</label>
                <textarea name="reservation_template_closing" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="Mohon info ketersediaannya. Terima kasih.">{{ old('reservation_template_closing', $reservationSettings['template_closing'] ?? 'Mohon info ketersediaannya. Terima kasih.') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Opsi Subjek Reservasi</label>
                <textarea name="reservation_subject_options" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="Satu baris satu opsi">{{ old('reservation_subject_options', $reservationSubjectOptionsText) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Isi satu opsi per baris. Contoh: Pertanyaan Umum, Pemesanan Acara, Reservasi Grup.</p>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-6">Jam Operasional</h3>

            <div x-data="hoursManager()">
                <template x-for="(hour, index) in hours" :key="index">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex-1">
                            <input type="text" x-model="hour.day" :name="`days[${index}]`" placeholder="contoh: Senin - Jumat" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                        </div>
                        <div class="flex-1">
                            <input type="text" x-model="hour.time" :name="`times[${index}]`" placeholder="contoh: 07:00 WIB - 21:00 WIB" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                        </div>
                        <button type="button" @click="removeHour(index)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </template>

                <button type="button" @click="addHour()" class="text-sm text-[#D4A373] font-medium hover:underline flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Jam
                </button>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('hoursManager', () => ({
            hours: {!! json_encode(count($hours) > 0 ? $hours : [['day' => '', 'time' => '']]) !!},
            
            addHour() {
                this.hours.push({ day: '', time: '' });
            },
            
            removeHour(index) {
                if (this.hours.length > 1) {
                    this.hours.splice(index, 1);
                } else {
                    this.hours[0] = { day: '', time: '' };
                }
            }
        }));
    });
</script>
@endsection
