@extends('layouts.admin')

@section('content')
<div class="p-6 lg:p-8 max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Bagian Tim</h1>
            <p class="text-gray-500 mt-1">Kelola anggota tim yang ditampilkan di halaman Tentang.</p>
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

    {{-- Form Tambah Anggota --}}
    <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm border border-gray-100 mb-8">
        <h3 class="text-lg font-semibold mb-6 border-b pb-2">Tambah Anggota Tim</h3>
        <form action="{{ route('admin.settings.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Budi Santoso">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Peran / Jabatan *</label>
                    <input type="text" name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent" placeholder="contoh: Kepala Barista">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                    <input type="number" name="order" min="0" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                    Tambah Anggota
                </button>
            </div>
        </form>
    </div>

    {{-- Daftar Anggota Saat Ini --}}
    <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold mb-6 border-b pb-2">Daftar Anggota Tim ({{ $members->count() }})</h3>

        @if($members->count() > 0)
            <div class="space-y-4">
                @foreach($members as $member)
                    <div class="border border-gray-100 rounded-xl p-4 hover:border-[#D4A373]/30 transition-all">
                        <form action="{{ route('admin.settings.team.update', $member) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    @if($member->image)
                                        <img src="{{ $member->image }}" alt="{{ $member->name }}" class="w-20 h-20 rounded-xl object-cover shadow-sm">
                                    @else
                                        <div class="w-20 h-20 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 text-2xl">
                                            ?
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Nama</label>
                                        <input type="text" name="name" value="{{ $member->name }}" required class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Peran</label>
                                        <input type="text" name="role" value="{{ $member->role }}" required class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Ganti Foto</label>
                                        <input type="file" name="image" accept="image/*" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Urutan</label>
                                        <input type="number" name="order" value="{{ $member->order }}" min="0" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D4A373] focus:border-transparent">
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2 flex-shrink-0">
                                    <button type="submit" class="px-4 py-1.5 bg-[#D4A373] text-white text-xs rounded-lg font-medium hover:bg-[#c49363] transition-colors">
                                        Perbarui
                                    </button>
                        </form>
                                    <form action="{{ route('admin.settings.team.destroy', $member) }}" method="POST" onsubmit="return confirm('Hapus anggota tim ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-1.5 bg-red-50 text-red-600 text-xs rounded-lg font-medium hover:bg-red-100 transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 text-gray-400">
                <p class="text-lg mb-2">Belum ada anggota tim.</p>
                <p class="text-sm">Gunakan formulir di atas untuk menambahkan anggota tim.</p>
            </div>
        @endif
    </div>
</div>
@endsection
