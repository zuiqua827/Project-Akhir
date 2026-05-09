@extends('layouts.admin')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="flex items-center gap-3 sm:gap-4 mb-8">
            <a href="{{ route('admin.products.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Edit Produk</h1>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm p-5 sm:p-6 lg:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk *</label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $product->name) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="Masukkan nama produk">
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                        <input type="number" id="price" name="price" step="1" min="0" required value="{{ old('price', $product->price) }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="0">
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi / Penjelasan Produk</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="Tulis penjelasan produk yang akan tampil saat produk di menu diklik...">{{ old('description', $product->description) }}</textarea>
                    <p class="text-xs text-gray-500 mt-2">Deskripsi ini akan tampil di kartu menu dan halaman detail produk.</p>
                </div>

                <div class="lg:col-span-2">
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Unggah Gambar</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]">
                    <p class="text-sm text-gray-500 mt-2">Gambar Saat Ini: <a href="{{ $product->image }}" target="_blank" class="text-blue-500 underline">Lihat</a></p>
                </div>

                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                    <select id="category" name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]">
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ $product->category === $category ? 'selected' : '' }}>{{ $categoryLabels[$category] ?? ucfirst(str_replace('-', ' ', $category)) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Status</label>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_featured" {{ $product->is_featured ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                            <span class="text-gray-700">Unggulan Produk</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_special" {{ $product->is_special ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                            <span class="text-gray-700">Penawaran Spesial</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_available" {{ $product->is_available ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                            <span class="text-gray-700">Tersedia untuk Dipesan</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-end gap-3 sm:gap-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.products.index') }}" class="w-full sm:w-auto text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
@endsection
