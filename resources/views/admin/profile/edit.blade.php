@extends('layouts.admin')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-6">
    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start gap-3">
            <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
            <div>
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Profile Card --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-[#D4A373] to-[#8B6F47] rounded-full flex items-center justify-center">
                        <span class="text-2xl font-bold text-white">{{ auth()->user()->initials() }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ auth()->user()->email }}</p>
                    <p class="text-xs text-gray-500 mt-3">
                        Bergabung sejak {{ auth()->user()->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Forms --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Update Profile Form --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fa-solid fa-user mr-2"></i>Edit Profil
                </h2>
                
                <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', auth()->user()->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D4A373] focus:border-transparent @error('name') border-red-500 @enderror"
                            required
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', auth()->user()->email) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D4A373] focus:border-transparent @error('email') border-red-500 @enderror"
                            required
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex flex-col sm:flex-row justify-end pt-2">
                        <button 
                            type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-[#D4A373] text-white rounded-lg hover:bg-[#C4935D] transition-colors font-medium text-sm shadow-sm"
                        >
                            <i class="fa-solid fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- Update Password Form --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fa-solid fa-lock mr-2"></i>Ubah Password
                </h2>
                
                <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Current Password --}}
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                        <input 
                            type="password" 
                            id="current_password" 
                            name="current_password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D4A373] focus:border-transparent @error('current_password') border-red-500 @enderror"
                            required
                        >
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D4A373] focus:border-transparent @error('password') border-red-500 @enderror"
                            required
                        >
                        <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter dengan huruf besar, huruf kecil, angka, dan simbol.</p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D4A373] focus:border-transparent @error('password_confirmation') border-red-500 @enderror"
                            required
                        >
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex flex-col sm:flex-row justify-end pt-2">
                        <button 
                            type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-[#D4A373] text-white rounded-lg hover:bg-[#C4935D] transition-colors font-medium text-sm shadow-sm"
                        >
                            <i class="fa-solid fa-save mr-2"></i>Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
