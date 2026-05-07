@extends('layouts.admin')

@section('content')
<div class="p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">🦶 Footer Settings</h1>
            <p class="text-gray-500 mt-1">Kelola konten footer yang tampil di semua halaman website.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200">
            {{ session('success') }}
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

    <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <form action="{{ route('admin.settings.footer') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold border-b pb-2">🏷️ Branding</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand Name</label>
                    <input type="text" name="brand_name" value="{{ $settings['brand_name'] ?? 'Ara' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="e.g. Ara">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand Accent (Warna Gold)</label>
                    <input type="text" name="brand_accent" value="{{ $settings['brand_accent'] ?? 'CAFÉ' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="e.g. CAFÉ">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tagline / Deskripsi</label>
                <textarea name="tagline" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['tagline'] ?? 'Crafting moments of clarity and warmth through the art of specialty coffee. Join us in our journey of flavor and community.' }}</textarea>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-4">🔗 Social Media</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                    <input type="text" name="instagram_url" value="{{ $settings['instagram_url'] ?? '#' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="https://instagram.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">TikTok URL</label>
                    <input type="text" name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '#' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="https://tiktok.com/@...">
                </div>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-4">📌 Address & Contact</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['address'] ?? "123 Roaster Avenue\nCoffee District, NY 10012" }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Gunakan enter untuk baris baru.</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="text" name="email" value="{{ $settings['email'] ?? 'hello@cafe.com' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="hello@cafe.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ $settings['phone'] ?? '+1 (555) 000-8888' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="+62 812 3456 7890">
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 pt-4">📄 Copyright</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Copyright Text</label>
                    <input type="text" name="copyright" value="{{ $settings['copyright'] ?? '© 2024 Café Collective. All rights reserved.' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bottom Tagline</label>
                    <input type="text" name="bottom_text" value="{{ $settings['bottom_text'] ?? 'Built with Passion and Caffeine.' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
