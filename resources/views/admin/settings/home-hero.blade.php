@extends('layouts.admin')

@section('content')
<div class="p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Home Hero Settings</h1>
            <p class="text-gray-500 mt-1">Configure the main hero section on the homepage.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <form action="{{ route('admin.settings.home.hero') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Badge Text</label>
                    <input type="text" name="badge" value="{{ $settings['badge'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="e.g. Est. 2024">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">CTA Button Text</label>
                    <input type="text" name="cta_text" value="{{ $settings['cta_text'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="e.g. Explore Menu">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Main Title</label>
                    <input type="text" name="title" value="{{ $settings['title'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="e.g. Freshly Brewed">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Accent Subtitle (Italic)</label>
                    <input type="text" name="subtitle" value="{{ $settings['subtitle'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="e.g. For You.">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Main Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">{{ $settings['description'] ?? '' }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sub Description (Smaller text)</label>
                <input type="text" name="sub_description" value="{{ $settings['sub_description'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Background Image URL</label>
                <input type="text" name="background_image" value="{{ $settings['background_image'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                @if(!empty($settings['background_image']))
                    <div class="mt-4 rounded-xl overflow-hidden h-40 relative">
                        <img src="{{ $settings['background_image'] }}" class="w-full h-full object-cover">
                    </div>
                @endif
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
