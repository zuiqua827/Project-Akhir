@extends('layouts.admin')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Pengaturan Hero & Statistik Tentang</h1>
            <p class="text-gray-500 mt-1">Atur bagian hero utama dan statistik pada halaman tentang.</p>
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
        <form action="{{ route('admin.settings.about.hero') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold border-b pb-2">Bagian Hero</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Badge</label>
                    <input type="text" name="badge" value="{{ $settings['badge'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Utama</label>
                    <input type="text" name="title" value="{{ $settings['title'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subjudul Aksen (Miring)</label>
                    <input type="text" name="subtitle" value="{{ $settings['subtitle'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Paragraph 1</label>
                <textarea name="description1" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['description1'] ?? '' }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Paragraph 2</label>
                <textarea name="description2" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['description2'] ?? '' }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                    <input type="file" name="image1" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]">
                    <p class="text-sm text-gray-500 mt-1">Kosongkan untuk mempertahankan gambar saat ini.</p>
                    @if(!empty($settings['image1']))
                        <div class="mt-2 rounded-xl overflow-hidden h-32">
                            <img src="{{ $settings['image1'] }}" class="w-full h-full object-cover rounded-xl">
                        </div>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Kedua (Mengambang)</label>
                    <input type="file" name="image2" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]">
                    <p class="text-sm text-gray-500 mt-1">Kosongkan untuk mempertahankan gambar saat ini.</p>
                    @if(!empty($settings['image2']))
                        <div class="mt-2 rounded-xl overflow-hidden h-32">
                            <img src="{{ $settings['image2'] }}" class="w-full h-full object-cover rounded-xl">
                        </div>
                    @endif
                </div>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-6">Statistik</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-gray-50 rounded-xl space-y-4">
                    <h4 class="font-medium text-gray-700">Statistik 1</h4>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Nilai (contoh: 100%)</label>
                        <input type="text" name="stat1_value" value="{{ $stats['stat1_value'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label (contoh: Biji Organik)</label>
                        <input type="text" name="stat1_label" value="{{ $stats['stat1_label'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                    </div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl space-y-4">
                    <h4 class="font-medium text-gray-700">Statistik 2</h4>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Nilai (contoh: 15+)</label>
                        <input type="text" name="stat2_value" value="{{ $stats['stat2_value'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label (contoh: Asal Negara)</label>
                        <input type="text" name="stat2_label" value="{{ $stats['stat2_label'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                    </div>
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
