{{-- resources/views/manager/projects/index.blade.php --}}
@extends('layouts.manager')

@section('title', 'Projects')
@section('breadcrumb', 'Projects')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Projects</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar semua project yang sedang berjalan</p>
        </div>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden md:block bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Project</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Contract Value</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Budget</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach($projects as $p)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $p->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $p->client->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">Rp {{ number_format($p->contract_value) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">Rp {{ number_format($p->budget) }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                    @if($p->status == 'active') bg-green-100 text-green-700
                                    @elseif($p->status == 'completed') bg-blue-100 text-blue-700
                                    @elseif($p->status == 'on_hold') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-600
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('manager.projects.members.index', $p->id) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-medium rounded-lg transition">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    Anggota
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($projects->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

    {{-- Mobile Card View --}}
    <div class="md:hidden space-y-3">
        @foreach($projects as $p)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">

                {{-- Card Header --}}
                <div class="flex items-start justify-between gap-2 mb-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $p->name }}</p>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $p->client->name }}</p>
                    </div>
                    <span class="flex-shrink-0 px-2.5 py-1 text-xs font-medium rounded-full
                        @if($p->status == 'active') bg-green-100 text-green-700
                        @elseif($p->status == 'completed') bg-blue-100 text-blue-700
                        @elseif($p->status == 'on_hold') bg-yellow-100 text-yellow-700
                        @else bg-gray-100 text-gray-600
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                    </span>
                </div>

                {{-- Card Body --}}
                <div class="grid grid-cols-2 gap-2 mb-3">
                    <div class="bg-gray-50 rounded-lg p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Contract Value</p>
                        <p class="text-xs font-semibold text-gray-700">Rp {{ number_format($p->contract_value) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Budget</p>
                        <p class="text-xs font-semibold text-gray-700">Rp {{ number_format($p->budget) }}</p>
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="flex justify-end">
                    <a href="{{ route('manager.projects.members.index', $p->id) }}"
                       class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-medium rounded-lg transition">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Anggota
                    </a>
                </div>
            </div>
        @endforeach

        {{-- Pagination Mobile --}}
        @if($projects->hasPages())
            <div class="mt-2">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

@endsection