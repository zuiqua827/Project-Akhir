@extends('layouts.admin')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Produk</h1>
            <a href="{{ route('admin.products.create') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 px-6 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Produk
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
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
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $product->image }}" class="w-16 h-16 rounded-xl object-cover" alt="{{ $product->name }}">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $product->name }}</p>
                                            <p class="text-sm text-gray-500 line-clamp-1">{{ $product->description }}</p>
                                            {{-- @if($product->is_available)
                                                <a href="{{ route('menu.show', $product->id) }}" target="_blank" class="inline-block mt-1 text-xs text-[#D4A373] hover:underline">Lihat halaman penjelasan</a>
                                            @endif --}}
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
                        @endforeach
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
