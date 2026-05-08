@extends('layouts.admin')

@section('content')
    <div class="p-6 lg:p-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Galeri Momen</h1>
            <a href="{{ route('admin.moments.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#2D1B10] text-white rounded-xl font-medium hover:bg-[#4A2C1C] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Momen
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Pratinjau</th>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Keterangan</th>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Urutan</th>
                            <th class="text-left text-sm font-semibold text-gray-600 px-6 py-4">Status</th>
                            <th class="text-right text-sm font-semibold text-gray-600 px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($moments as $moment)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <img src="{{ $moment->image }}" class="w-20 h-20 rounded-xl object-cover" alt="{{ $moment->caption }}" onerror="this.src='https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=200'">
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-800 line-clamp-2">{{ $moment->caption }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-mono bg-gray-100 px-3 py-1 rounded-full">{{ $moment->order }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($moment->is_featured)
                                        <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Unggulan</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full">Biasa</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.moments.edit', $moment) }}" class="p-2 text-gray-600 hover:text-[#D4A373] hover:bg-[#D4A373]/10 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.moments.destroy', $moment) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p>Belum ada momen. <a href="{{ route('admin.moments.create') }}" class="text-[#D4A373] hover:underline font-medium">Tambahkan momen pertamamu!</a></p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($moments->hasPages())
                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $moments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
