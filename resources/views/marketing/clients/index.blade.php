@extends('layouts.marketing')

@section('title', 'Data Clients')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Clients</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola semua data client marketing</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('marketing.clients.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Client
            </a>
            <a href="{{ route('marketing.clients.export') }}"
               class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export Excel
            </a>
        </div>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="mb-4 flex items-center p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">No</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">Nama</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">Email</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">Telepon</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">Perusahaan</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">Alamat</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">Dibuat Oleh</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">Tanggal</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($clients as $client)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800 whitespace-nowrap">{{ $client->name }}</td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $client->email }}</td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $client->phone }}</td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $client->company }}</td>
                            <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $client->address }}</td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $client->creator->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $client->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('marketing.clients.edit', $client->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-amber-100 text-amber-700 text-xs font-medium rounded-lg hover:bg-amber-200 transition">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('marketing.clients.destroy', $client->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus client ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-xs font-medium rounded-lg hover:bg-red-200 transition">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <p class="font-medium">Belum ada data client</p>
                                <p class="text-sm mt-1">Mulai dengan menambahkan client baru</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        
    </div>

@endsection