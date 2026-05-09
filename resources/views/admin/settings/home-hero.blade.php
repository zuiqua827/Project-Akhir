@extends('layouts.admin')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Pengaturan Hero Beranda</h1>
            <p class="text-gray-500 mt-1">Atur bagian hero utama di halaman beranda.</p>
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
        <form action="{{ route('admin.settings.home.hero') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Badge</label>
                    <input type="text" name="badge" value="{{ $settings['badge'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Est. 2024">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Tombol CTA</label>
                    <input type="text" name="cta_text" value="{{ $settings['cta_text'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Lihat Menu">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Utama</label>
                    <input type="text" name="title" value="{{ $settings['title'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Diseduh Segar">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subjudul Aksen (Miring)</label>
                    <input type="text" name="subtitle" value="{{ $settings['subtitle'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Untukmu.">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Utama</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['description'] ?? '' }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Subdeskripsi (teks lebih kecil)</label>
                <input type="text" name="sub_description" value="{{ $settings['sub_description'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Latar</label>
                <input type="file" name="background_image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]">
                <p class="text-sm text-gray-500 mt-1">Unggah gambar latar baru (JPEG, PNG, WEBP, maks 4MB). Kosongkan untuk mempertahankan gambar saat ini.</p>
                @if(!empty($settings['background_image']))
                    <div class="mt-4 rounded-xl overflow-hidden h-40 relative">
                        <p class="text-xs text-gray-400 mb-2">Gambar Saat Ini:</p>
                        <img src="{{ $settings['background_image'] }}" class="w-full h-full object-cover rounded-xl">
                    </div>
                @endif
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
