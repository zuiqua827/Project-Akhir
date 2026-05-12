@extends('layouts.admin')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Pengaturan Footer</h1>
            <p class="text-gray-500 mt-1">Kelola konten footer yang tampil di seluruh halaman website.</p>
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
        @php
            $brandName = trim((string) ($settings['brand_name'] ?? 'Ara'));
            $brandAccent = trim((string) ($settings['brand_accent'] ?? 'Cafe'));
            $brandText = trim($brandName . ' ' . $brandAccent);
            if ($brandText === '') {
                $brandText = 'Brand Kami';
            }

            $logoPreview = trim((string) ($settings['brand_logo'] ?? ''));
            if ($logoPreview === '') {
                foreach (['assets/Logo_Ara-removebg-preview.png', 'assets/logo-ara.jpg'] as $candidate) {
                    if (file_exists(public_path($candidate))) {
                        $logoPreview = asset($candidate);
                        break;
                    }
                }
            }
        @endphp
        <form action="{{ route('admin.settings.footer') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold border-b pb-2">Identitas Merek</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo Brand</label>
                <input type="file" name="brand_logo" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent file:mr-3 file:rounded-lg file:border-0 file:bg-[#2D1B10] file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti logo. Format: JPG, PNG, SVG, WEBP (maks. 4MB).</p>
                @if($logoPreview !== '')
                    <div class="mt-3 inline-flex items-center rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                        <img src="{{ $logoPreview }}" alt="Logo brand saat ini" class="h-14 w-auto object-contain">
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Merek</label>
                    <input type="text" name="brand_name" value="{{ $settings['brand_name'] ?? 'Ara' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Ara">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Aksen Merek (warna emas)</label>
                    <input type="text" name="brand_accent" value="{{ $settings['brand_accent'] ?? 'CAFE' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: CAFE">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tagline / Deskripsi</label>
                <textarea name="tagline" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['tagline'] ?? 'Meracik momen hangat dan penuh makna melalui seni kopi spesialti. Mari menikmati perjalanan rasa dan kebersamaan bersama kami.' }}</textarea>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-4">Media Sosial</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">URL Instagram</label>
                    <input type="text" name="instagram_url" value="{{ $settings['instagram_url'] ?? '#' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="https://instagram.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">URL TikTok</label>
                    <input type="text" name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '#' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="https://tiktok.com/@...">
                </div>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-4">Alamat dan Kontak</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['address'] ?? "Jl. KH Achmad Fauzan No.17\nKrasak, Bangsri, Jepara" }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Gunakan enter untuk baris baru.</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="text" name="email" value="{{ $settings['email'] ?? 'hello@cafe.com' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="hello@cafe.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                        <input type="text" name="phone" value="{{ $settings['phone'] ?? '+62 822-2300-5860' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="+62 822-2300-5860">
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-4">Hak Cipta</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Hak Cipta</label>
                    <input type="text" name="copyright" value="{{ $settings['copyright'] ?? ('Hak Cipta 2024 ' . $brandText . '. Seluruh hak cipta dilindungi.') }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Bagian Bawah</label>
                    <input type="text" name="bottom_text" value="{{ $settings['bottom_text'] ?? 'Dibuat dengan semangat dan secangkir kafein.' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
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
