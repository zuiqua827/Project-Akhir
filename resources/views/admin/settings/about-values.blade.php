@extends('layouts.admin')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 max-w-5xl mx-auto">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Pengaturan Nilai Tentang</h1>
            <p class="text-gray-500 mt-1">Atur section "Yang Menggerakkan Kami" pada halaman tentang.</p>
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
        <form action="{{ route('admin.settings.about.values') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold border-b pb-2">Heading Section</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $settings['title'] ?? 'Yang Menggerakkan Kami') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent"
                    placeholder="Yang Menggerakkan Kami"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea
                    name="description"
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent"
                    placeholder="Prinsip kami memandu setiap keputusan, dari biji hingga tersaji di cangkir."
                >{{ old('description', $settings['description'] ?? 'Prinsip kami memandu setiap keputusan, dari biji hingga tersaji di cangkir.') }}</textarea>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2">Kartu Nilai</h3>

            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
                <strong>Tips:</strong> Gunakan class icon Font Awesome, contoh:
                <code class="font-mono">fa-solid fa-gem</code>,
                <code class="font-mono">fa-solid fa-leaf</code>.
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                @foreach($valueItems as $index => $item)
                    <div class="rounded-xl border border-gray-200 p-4 sm:p-5 space-y-4">
                        <h4 class="text-sm font-semibold text-gray-800">Nilai {{ $index + 1 }}</h4>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Class Icon</label>
                            <input
                                type="text"
                                name="items[{{ $index }}][icon]"
                                value="{{ old('items.' . $index . '.icon', $item['icon']) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent"
                                placeholder="fa-solid fa-gem"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Kartu</label>
                            <input
                                type="text"
                                name="items[{{ $index }}][title]"
                                value="{{ old('items.' . $index . '.title', $item['title']) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent"
                                placeholder="Kualitas Utama"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Kartu</label>
                            <textarea
                                name="items[{{ $index }}][desc]"
                                rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent"
                                placeholder="Deskripsi singkat nilai ini..."
                            >{{ old('items.' . $index . '.desc', $item['desc']) }}</textarea>
                        </div>
                    </div>
                @endforeach
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
