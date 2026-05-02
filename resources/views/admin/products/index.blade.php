@extends('layouts.admin')

@section('content')
    <div class="p-6 lg:p-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Products</h1>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Product
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endisset

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Product</th>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Category</th>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Price</th>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Status</th>
                            <th class="text-right text-sm font-semibold text-gray-600 px-6 py-4">Actions</th>
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
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 text-sm font-medium capitalize bg-gray-100 text-gray-700 rounded-full">
                                        {{ str_replace('-', ' ', $product->category) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-lg font-semibold text-gray-800">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if($product->is_featured)
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Featured</span>
                                        @endif
                                        @if($product->is_special)
                                            <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-700 rounded-full">Special</span>
                                        @endif
                                        @if(!$product->is_available)
                                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Unavailable</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-gray-600 hover:text-[#D4A373] hover:bg-[#D4A373]/10 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
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
