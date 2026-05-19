@extends('layouts.admin')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Kategori Produk</h1>
                <p class="text-gray-500 mt-1">Kelola kategori yang akan dipakai pada form input produk.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 px-5 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Produk
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-200">
                {{ session('error') }}
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

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-5">Tambah Kategori</h2>
                <form action="{{ route('admin.product-categories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori *</label>
                        <input id="name" type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="Contoh: Kopi Susu" value="{{ old('name') }}">
                    </div>
                    <div>
                        <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampil</label>
                        <input id="order" type="number" name="order" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" value="{{ old('order', 0) }}">
                    </div>
                    <button type="submit" class="w-full px-6 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                        Simpan Kategori
                    </button>
                </form>
            </div>

            <div class="xl:col-span-2 bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-5">Daftar Kategori ({{ $categories->count() }})</h2>

                @if($categories->isEmpty())
                    <p class="text-gray-500 text-sm">Belum ada kategori. Tambahkan kategori pertama dari form di samping.</p>
                @else
                    <div class="space-y-3">
                        @foreach($categories as $category)
                            <div class="border border-gray-100 rounded-xl p-4 hover:border-[#D4A373]/30 transition-colors">
                                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                    <form action="{{ route('admin.product-categories.update', $category->id) }}" method="POST" class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 mb-1">Nama Kategori</label>
                                            <input type="text" name="name" required value="{{ $category->name }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D4A373]/40 focus:border-[#D4A373]">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 mb-1">Urutan</label>
                                            <input type="number" name="order" min="0" value="{{ $category->order }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D4A373]/40 focus:border-[#D4A373]">
                                        </div>
                                        <div class="sm:col-span-2 flex items-center justify-between gap-3">
                                            <span class="text-xs text-gray-500">Dipakai oleh {{ $category->products_count }} produk</span>
                                            <button type="submit" class="px-4 py-2 bg-[#D4A373] text-white text-sm rounded-lg font-medium hover:bg-[#c49363] transition-colors">
                                                Perbarui
                                            </button>
                                        </div>
                                    </form>

                                    <form action="{{ route('admin.product-categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full md:w-auto px-4 py-2 text-sm rounded-lg font-medium transition-colors {{ $category->products_count > 0 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-red-50 text-red-600 hover:bg-red-100' }}" {{ $category->products_count > 0 ? 'disabled' : '' }}>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
