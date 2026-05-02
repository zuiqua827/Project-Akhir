@extends('layouts.admin')

@section('content')
    <div class="p-6 lg:p-8">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.products.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="bg-white rounded-2xl shadow-sm p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Product Name *</label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $product->name) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="Enter product name">
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                        <input type="number" id="price" name="price" step="0.01" min="0" required value="{{ old('price', $product->price) }}" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="0.00">
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="lg:col-span-2">
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Image URL</label>
                    <input type="url" id="image" name="image" value="{{ old('image', $product->image) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="https://example.com/image.jpg">
                </div>

                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                    <select id="category" name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]">
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ $product->category === $category ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $category)) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Status</label>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_featured" {{ $product->is_featured ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                            <span class="text-gray-700">Featured Product</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_special" {{ $product->is_special ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                            <span class="text-gray-700">Special Offer</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_available" {{ $product->is_available ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                            <span class="text-gray-700">Available for Order</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection
