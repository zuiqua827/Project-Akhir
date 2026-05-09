@extends('layouts.admin')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Pengaturan Bagian Lokasi</h1>
            <p class="text-gray-500 mt-1">Atur bagian lokasi pada halaman beranda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-200">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl p-4 sm:p-6 lg:p-8 shadow-sm border border-gray-100">
        <form action="{{ route('admin.settings.home.location') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold border-b pb-2">Judul</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Badge</label>
                    <input type="text" name="badge" value="{{ $settings['badge'] ?? 'Kunjungi Kami' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Kunjungi Kami">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Tombol CTA</label>
                    <input type="text" name="cta_text" value="{{ $settings['cta_text'] ?? 'Lihat Rute' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Lihat Rute">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Utama</label>
                    <input type="text" name="title" value="{{ $settings['title'] ?? 'Temukan' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Temukan">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subjudul Aksen (Miring)</label>
                    <input type="text" name="subtitle" value="{{ $settings['subtitle'] ?? 'Ruang Nyamanmu.' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Ruang Nyamanmu.">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['description'] ?? 'Berada di jantung Jepara, cafe kami menghadirkan suasana hangat yang cocok untuk bekerja, bersantai, atau berkumpul bersama teman.' }}</textarea>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-4">Detail Lokasi</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                <input type="text" name="address" value="{{ $settings['address'] ?? 'Jl. KH Achmad Fauzan No.17, Krasak, Bangsri' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Jl. Contoh No.123, Kota">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
                <input type="text" name="hours" value="{{ $settings['hours'] ?? 'Buka Setiap Hari: 07:00 - 21:00 WIB' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Buka Setiap Hari: 07:00 - 21:00 WIB">
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-4">Google Maps</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Tempat / Alamat di Google Maps</label>
                <input type="text" name="maps_query" value="{{ $settings['maps_query'] ?? 'Krasak, Bangsri, Jepara, Jawa Tengah' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: SMK N 1 BANGSRI">
                <p class="text-sm text-gray-500 mt-1">Ketik nama tempat atau alamat lengkap. Peta akan otomatis menampilkan lokasi tersebut.</p>

                @php
                    $query = $settings['maps_query'] ?? 'Krasak, Bangsri, Jepara, Jawa Tengah';
                    $previewUrl = 'https://maps.google.com/maps?q=' . urlencode($query) . '&output=embed';
                @endphp
                <div class="mt-4 rounded-xl overflow-hidden h-48 border border-gray-200">
                    <iframe src="{{ $previewUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
