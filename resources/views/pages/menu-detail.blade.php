@extends('layouts.app')

@section('content')
    <section class="pt-32 pb-16 bg-[#FDFBF7]">
        <div class="max-w-6xl mx-auto px-6 lg:px-12">
            <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#D4A373] hover:text-[#2D1B10] transition-colors">
                <span aria-hidden="true">&larr;</span>
                <span>Kembali ke Menu</span>
            </a>

            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
                <div class="rounded-3xl overflow-hidden shadow-lg bg-white">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-[420px] object-cover">
                </div>

                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#D4A373] font-semibold">{{ $product->category_label }}</p>
                    <h1 class="mt-3 text-4xl md:text-5xl font-serif text-[#2D1B10] leading-tight">{{ $product->name }}</h1>

                    <div class="mt-4 flex items-center gap-3 flex-wrap">
                        <span class="inline-flex px-4 py-2 rounded-full bg-[#2D1B10] text-white text-sm font-semibold">{{ $product->formatted_price }}</span>
                        @if($product->is_featured)
                            <span class="inline-flex px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">Terlaris</span>
                        @endif
                        @if($product->is_special)
                            <span class="inline-flex px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold">Spesial</span>
                        @endif
                    </div>

                    <div class="mt-8 rounded-2xl bg-white border border-[#2D1B10]/10 p-6">
                        <h2 class="text-lg font-semibold text-[#2D1B10] mb-3">Penjelasan Produk</h2>
                        <p class="text-[#2D1B10]/70 leading-relaxed whitespace-pre-line">
                            {{ $product->description ?: 'Penjelasan produk belum diisi. Kamu bisa atur deskripsi ini di Panel Admin > Produk > Edit.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
