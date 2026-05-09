@extends('layouts.admin')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Pengaturan Galeri Beranda</h1>
            <p class="text-gray-500 mt-1">Atur judul bagian galeri pada halaman beranda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl p-4 sm:p-6 lg:p-8 shadow-sm border border-gray-100">
        <form action="{{ route('admin.settings.home.gallery') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Teks Badge</label>
                <input type="text" name="badge" value="{{ $settings['badge'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Bagian</label>
                <input type="text" name="title" value="{{ $settings['title'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
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
