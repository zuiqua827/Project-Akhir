@extends('layouts.admin')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        @php
            $latestProducts = \App\Models\Product::with('category')->latest()->take(5)->get();
            $latestMoments = \App\Models\Moment::latest()->take(5)->get();
        @endphp

        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-8 lg:hidden">Dasbor</h1>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 sm:gap-6 mb-8">
            <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Produk</p>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ \App\Models\Product::count() }}</p>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-[#D4A373]/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Momen</p>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ \App\Models\Moment::count() }}</p>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-indigo-50 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zm0 0v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 4v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 10v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 16v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 3h20v2H2V3zM2 7h20v2H2V7zM2 11h20v2H2V11zM2 15h20v2H2V15zM2 19h20v2H2V19z"></path></svg>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Unggulan</p>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ \App\Models\Product::where('is_featured', true)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-blue-50 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Spesial</p>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ \App\Models\Product::where('is_special', true)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-purple-50 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tersedia</p>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ \App\Models\Product::where('is_available', true)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-green-50 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Aksi Cepat</h2>
            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3 sm:gap-4">
                <a href="{{ route('admin.products.create') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 px-6 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Produk
                </a>
                <a href="{{ route('admin.moments.create') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zm0 0v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 4v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 10v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1zM2 16v1a1 1 0 01-1 1H1a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 3h20v2H2V3zM2 7h20v2H2V7zM2 11h20v2H2V11zM2 15h20v2H2V15zM2 19h20v2H2V19z"></path></svg>
                    Tambah Momen
                </a>
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Lihat Website
                </a>

            </div>
        </div>

        {{-- Produk Terbaru --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm mb-8">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Produk Terbaru</h2>
                <a href="{{ route('admin.products.index') }}" class="text-sm text-[#D4A373] hover:underline">Lihat Semua</a>
            </div>
            <div class="md:hidden space-y-3">
                @forelse($latestProducts as $product)
                    <article class="rounded-xl border border-gray-200 p-4">
                        <div class="flex items-start gap-3">
                            <img src="{{ $product->image }}" class="w-14 h-14 rounded-xl object-cover shrink-0" alt="{{ $product->name }}">
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-gray-800 break-words">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $product->category_label }}</p>
                                <p class="text-sm font-semibold text-gray-800 mt-2">{{ $product->formatted_price }}</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-3">
                            @if($product->is_featured)
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Unggulan</span>
                            @endif
                            @if($product->is_special)
                                <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-700 rounded-full">Spesial</span>
                            @endif
                            @if(!$product->is_available)
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Tidak Tersedia</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Tersedia</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="py-8 text-center text-gray-500 text-sm">Belum ada produk</p>
                @endforelse
            </div>

            <div class="hidden md:block -mx-4 sm:mx-0 overflow-x-auto pb-1">
                <div class="px-4 sm:px-0">
                    <table class="w-full min-w-[620px]">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left text-sm font-semibold text-gray-600 pb-4">Produk</th>
                                <th class="text-left text-sm font-semibold text-gray-600 pb-4">Kategori</th>
                                <th class="text-left text-sm font-semibold text-gray-600 pb-4">Harga</th>
                                <th class="text-left text-sm font-semibold text-gray-600 pb-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($latestProducts as $product)
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $product->image }}" class="w-12 h-12 rounded-xl object-cover" alt="{{ $product->name }}">
                                            <span class="font-medium text-gray-800">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <span class="capitalize text-sm text-gray-600">{{ $product->category_label }}</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="font-medium text-gray-800">{{ $product->formatted_price }}</span>
                                    </td>
                                    <td class="py-4">
                                        <div class="flex flex-wrap gap-2">
                                            @if($product->is_featured)
                                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Unggulan</span>
                                            @endif
                                            @if($product->is_special)
                                                <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-700 rounded-full">Spesial</span>
                                            @endif
                                            @if(!$product->is_available)
                                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Tidak Tersedia</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-gray-500 text-sm">
                                        Belum ada produk
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Momen Terbaru --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Momen Terbaru</h2>
                <a href="{{ route('admin.moments.index') }}" class="text-sm text-[#D4A373] hover:underline">Lihat Semua</a>
            </div>

            {{-- Mobile / Galeri Momen: tampil sebagai list kartu biar rapi di layar kecil --}}
            <div class="md:hidden space-y-3">
                @forelse($latestMoments as $moment)
                    <article class="rounded-xl border border-gray-200 p-4">
                        <div class="flex items-start gap-3">
                            <img
                                src="{{ $moment->image }}"
                                class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl object-cover shrink-0"
                                alt="{{ $moment->caption }}"
                                onerror="this.src='https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=150'"
                            >

                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-gray-800 break-words line-clamp-2">{{ $moment->caption }}</p>

                                <div class="mt-2 flex items-center justify-between gap-3">
                                    <p class="text-xs text-gray-500 shrink-0">Urutan</p>
                                    <span class="inline-flex text-sm font-mono bg-gray-100 px-2 py-1 rounded-full shrink-0">{{ $moment->order }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="py-8 text-center text-gray-500 text-sm">Belum ada momen</p>
                @endforelse
            </div>


            <div class="hidden md:block -mx-4 sm:mx-0 overflow-x-auto pb-1">
                <div class="px-4 sm:px-0">
                    <table class="w-full min-w-[620px]">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left text-sm font-semibold text-gray-600 pb-4">Pratinjau</th>
                                <th class="text-left text-sm font-semibold text-gray-600 pb-4">Keterangan</th>
                                <th class="text-left text-sm font-semibold text-gray-600 pb-4">Urutan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($latestMoments as $moment)
                                <tr>
                                    <td class="py-4">
                                        <img src="{{ $moment->image }}" class="w-12 h-12 rounded-xl object-cover" alt="{{ $moment->caption }}" onerror="this.src='https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=150'">
                                    </td>
                                    <td class="py-4">
                                        <p class="line-clamp-1 font-medium text-gray-800">{{ $moment->caption }}</p>
                                    </td>
                                    <td class="py-4">
                                        <span class="text-sm font-mono bg-gray-100 px-2 py-1 rounded-full">{{ $moment->order }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-12 text-center text-gray-500 text-sm">
                                        Belum ada momen
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
