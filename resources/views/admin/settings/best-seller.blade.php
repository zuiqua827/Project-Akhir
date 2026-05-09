@extends('layouts.admin')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Pengaturan Produk Terlaris</h1>
            <p class="text-gray-500 mt-1">Centang produk yang ingin ditampilkan sebagai Terlaris di halaman utama.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl p-4 sm:p-6 lg:p-8 shadow-sm border border-gray-100">
        <form action="{{ route('admin.settings.best-seller') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Info --}}
            <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
                <strong>Info:</strong> Produk yang dicentang akan muncul di bagian <strong>"Terlaris"</strong> di halaman utama website.
                Hanya produk yang statusnya <em>Tersedia</em> yang ditampilkan di sini.
            </div>

            @if($products->count() > 0)
                <div class="space-y-3">
                    @foreach($products as $product)
                        <label class="flex items-start sm:items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-[#D4A373] hover:bg-[#D4A373]/5 transition-all cursor-pointer group">
                            <input
                                type="checkbox"
                                name="best_sellers[]"
                                value="{{ $product->id }}"
                                {{ $product->is_featured ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]"
                            >
                            <div class="flex flex-wrap sm:flex-nowrap items-center gap-4 flex-1">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-14 h-14 rounded-xl object-cover shadow-sm">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 group-hover:text-[#D4A373] transition-colors">{{ $product->name }}</h4>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $product->category_label }} - {{ $product->formatted_price }}</p>
                                </div>
                                @if($product->is_featured)
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-[#D4A373]/10 text-[#D4A373] text-xs font-bold rounded-full">
                                        Terlaris
                                    </span>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-gray-100">
                    <p class="text-sm text-gray-500">
                        <span class="font-semibold text-[#D4A373]">{{ $products->where('is_featured', true)->count() }}</span> produk dipilih sebagai Terlaris
                    </p>
                    <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            @else
                <div class="text-center py-12 text-gray-400">
                    <p class="text-lg mb-2">Belum ada produk.</p>
                    <p class="text-sm">Tambahkan produk terlebih dahulu melalui menu <a href="{{ route('admin.products.create') }}" class="text-[#D4A373] underline">Produk</a>.</p>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
