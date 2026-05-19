@extends('layouts.admin')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Produk</h1>
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <a href="{{ route('admin.product-categories.index') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path></svg>
                    Tambah Kategori
                </a>
                <a href="{{ route('admin.products.create') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 px-6 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Produk
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.products.index') }}" method="GET" class="mb-6 flex flex-col sm:flex-row gap-3 sm:items-center">
            <div class="relative flex-1">
                <span class="pointer-events-none absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"></path>
                    </svg>
                </span>
                <input
                    type="text"
                    name="q"
                    value="{{ $keyword }}"
                    placeholder="Cari nama produk, deskripsi, atau kategori..."
                    class="w-full rounded-xl border border-gray-300 pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4A373] focus:border-[#D4A373]"
                >
            </div>
            <div class="flex w-full sm:w-auto gap-2">
                <button type="submit" class="inline-flex flex-1 sm:flex-none justify-center items-center gap-2 px-5 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    Cari
                </button>
                @if($keyword !== '')
                    <a href="{{ route('admin.products.index') }}" class="inline-flex flex-1 sm:flex-none justify-center items-center gap-2 px-5 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        @if($keyword !== '')
            <p class="text-sm text-gray-600 mb-4">
                Hasil pencarian untuk <span class="font-semibold text-gray-800">"{{ $keyword }}"</span>: {{ $products->total() }} produk.
            </p>
        @endif

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="md:hidden p-4 space-y-3">
                @forelse($products as $product)
                    <article class="rounded-xl border border-gray-200 p-4">
                        <div class="flex items-start gap-3">
                            <img src="{{ $product->image }}" class="w-14 h-14 rounded-xl object-cover shrink-0" alt="{{ $product->name }}">
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-gray-800 break-words">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-2 break-words">{{ $product->description ?: 'Tanpa deskripsi.' }}</p>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium capitalize bg-gray-100 text-gray-700 rounded-full">
                                        {{ $product->category_label }}
                                    </span>
                                    <span class="text-sm font-semibold text-gray-800">{{ $product->formatted_price }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex flex-1 justify-center items-center gap-2 px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex w-full justify-center items-center gap-2 px-3 py-2 text-sm text-red-700 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="py-8 text-center text-sm text-gray-500">
                        @if($keyword !== '')
                            Tidak ada produk yang cocok dengan kata kunci "{{ $keyword }}".
                        @else
                            Belum ada produk untuk ditampilkan.
                        @endif
                    </div>
                @endforelse
            </div>

            <div class="hidden md:block overflow-x-auto">
                <table class="w-full min-w-[720px]">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Produk</th>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Kategori</th>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Harga</th>
                            <th class="text-right text-sm font-semibold text-gray-600 px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $product->image }}" class="w-16 h-16 rounded-xl object-cover" alt="{{ $product->name }}">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $product->name }}</p>
                                            <p class="text-sm text-gray-500 line-clamp-1">{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 text-sm font-medium capitalize bg-gray-100 text-gray-700 rounded-full">
                                        {{ $product->category_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-lg font-semibold text-gray-800">{{ $product->formatted_price }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-gray-600 hover:text-[#D4A373] hover:bg-[#D4A373]/10 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500">
                                    @if($keyword !== '')
                                        Tidak ada produk yang cocok dengan kata kunci "{{ $keyword }}".
                                    @else
                                        Belum ada produk untuk ditampilkan.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
