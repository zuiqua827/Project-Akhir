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
                Hanya produk yang statusnya <em>Tersedia</em> yang ditampilkan di sini.<strong> Disclaimer</strong>: Produk terlaris hanya bisa menampilkan maksimal 5 produk saja.
            </div>

            @if($products->count() > 0)
                {{-- Search Box --}}
                <div class="relative mb-6">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input
                        type="text"
                        id="product-search"
                        placeholder="Cari nama produk atau kategori..."
                        class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-gray-200 focus:border-[#D4A373] focus:ring-2 focus:ring-[#D4A373]/20 transition-all outline-none text-sm text-gray-800 placeholder-gray-400"
                    >
                    <button
                        type="button"
                        id="search-clear"
                        class="hidden absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                        title="Bersihkan pencarian"
                    >
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                </div>

                <div class="space-y-3" id="product-list">
                    @foreach($products as $product)
                        <label class="product-item flex items-start sm:items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-[#D4A373] hover:bg-[#D4A373]/5 transition-all cursor-pointer group" data-name="{{ strtolower($product->name) }}" data-category="{{ strtolower($product->category_label) }}">
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
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-[#D4A373]/10 text-[#D4A373] text-xs font-bold rounded-full shrink-0">
                                        Terlaris
                                    </span>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>

                {{-- Empty State --}}
                <div id="empty-state" class="hidden text-center py-12 text-gray-400 border border-dashed border-gray-200 rounded-xl">
                    <i class="fa-solid fa-box-open text-3xl mb-3 block text-gray-300"></i>
                    <p class="text-base font-semibold mb-1">Produk tidak ditemukan</p>
                    <p class="text-xs text-gray-500">Coba cari dengan kata kunci lain.</p>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('product-search');
        const clearButton = document.getElementById('search-clear');
        const productItems = document.querySelectorAll('.product-item');
        const emptyState = document.getElementById('empty-state');

        if (!searchInput) return;

        function filterProducts() {
            const query = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            productItems.forEach(item => {
                const name = item.getAttribute('data-name') || '';
                const category = item.getAttribute('data-category') || '';

                if (name.includes(query) || category.includes(query)) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }

            if (query.length > 0) {
                clearButton?.classList.remove('hidden');
            } else {
                clearButton?.classList.add('hidden');
            }
        }

        searchInput.addEventListener('input', filterProducts);

        clearButton?.addEventListener('click', function () {
            searchInput.value = '';
            filterProducts();
            searchInput.focus();
        });
    });
</script>
@endsection
