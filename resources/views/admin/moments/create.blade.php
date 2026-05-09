@extends('layouts.admin')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="flex items-center gap-3 sm:gap-4 mb-8">
            <a href="{{ route('admin.moments.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Tambah Momen</h1>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.moments.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm p-5 sm:p-6 lg:p-8">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="lg:col-span-2">
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Unggah Gambar *</label>
                    <input type="file" id="image" name="image" accept="image/*" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]">
                    <p class="text-sm text-gray-500 mt-1">Unggah file gambar (JPEG, PNG, WEBP, maks 2MB)</p>
                    <div class="mt-2 p-4 bg-gray-50 rounded-xl">
                        <img id="image-preview" src="" alt="Pratinjau" class="w-full max-w-sm max-h-48 rounded-xl object-cover hidden">
                    </div>
                </div>

                <div>
                    <label for="caption" class="block text-sm font-semibold text-gray-700 mb-2">Keterangan *</label>
                    <input type="text" id="caption" name="caption" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="Masukkan keterangan untuk momen ini" maxlength="255">
                    <p class="text-xs text-gray-500 mt-1">Maksimal 255 karakter</p>
                </div>

                <div>
                    <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampil</label>
                    <input type="number" id="order" name="order" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373]/50 focus:border-[#D4A373]" placeholder="0">
                    <p class="text-sm text-gray-500 mt-1">Angka lebih kecil akan tampil lebih dulu (default: 0)</p>
                </div>

                <div>
                    <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition-colors group">
                        <input type="checkbox" name="is_featured" id="is_featured" class="w-5 h-5 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                        <span class="text-gray-700 font-medium group-hover:text-[#D4A373]">Jadikan momen ini unggulan</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-1">Unggulan moments get priority in gallery</p>
                </div>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-end gap-3 sm:gap-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.moments.index') }}" class="w-full sm:w-auto text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    Tambah Momen
                </button>
            </div>
        </form>
    </div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            preview.src = ev.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
});
</script>
@endsection
