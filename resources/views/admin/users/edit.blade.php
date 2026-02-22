@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.users') }}"
           class="p-2 text-gray-500 hover:text-slate-800 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit User</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi akun <span class="font-medium text-slate-600">{{ $user->name }}</span></p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 max-w-2xl">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-base font-semibold text-slate-700">Informasi Pengguna</h2>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="px-6 py-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="space-y-1.5">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" required
                       value="{{ old('name', $user->name) }}"
                       placeholder="Masukkan nama lengkap"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition placeholder-gray-400 @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="space-y-1.5">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" name="email" required
                       value="{{ old('email', $user->email) }}"
                       placeholder="contoh@email.com"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition placeholder-gray-400 @error('email') border-red-400 @enderror">
                @error('email')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="space-y-1.5">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <input type="password" id="password" name="password"
                       placeholder="Kosongkan jika tidak ingin diubah"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition placeholder-gray-400 @error('password') border-red-400 @enderror">
                <p class="text-xs text-gray-400">Biarkan kosong jika tidak ingin mengubah password.</p>
                @error('password')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div class="space-y-1.5">
                <label for="role_id" class="block text-sm font-medium text-gray-700">
                    Role <span class="text-red-500">*</span>
                </label>
                <select id="role_id" name="role_id" required
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition bg-white @error('role_id') border-red-400 @enderror">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update
                </button>
                <a href="{{ route('admin.users') }}"
                   class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>
@endsection