@extends('layouts.admin')

@section('title', 'Audit Log')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Audit Log</h1>
        <p class="text-sm text-gray-500 mt-1">Riwayat seluruh aktivitas yang terjadi di sistem</p>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 whitespace-nowrap">Waktu</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 whitespace-nowrap">User</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 whitespace-nowrap">Aksi</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 whitespace-nowrap">Modul</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 whitespace-nowrap">Deskripsi</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 whitespace-nowrap">IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($logs as $log)
                        <tr class="hover:bg-gray-50 transition-colors">

                            {{-- Waktu --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="text-gray-800 font-medium">{{ $log->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</div>
                            </td>

                            {{-- User --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if($log->user)
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center text-xs font-semibold text-slate-600 flex-shrink-0">
                                            {{ strtoupper(substr($log->user->email, 0, 1)) }}
                                        </div>
                                        <span class="text-gray-700 text-sm">{{ $log->user->email }}</span>
                                    </div>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                        </svg>
                                        System
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                @php
                                    $actionColors = [
                                        'create' => 'bg-green-100 text-green-700',
                                        'update' => 'bg-blue-100 text-blue-700',
                                        'delete' => 'bg-red-100 text-red-700',
                                        'login'  => 'bg-slate-100 text-slate-700',
                                        'logout' => 'bg-gray-100 text-gray-600',
                                    ];
                                    $colorClass = $actionColors[strtolower($log->action)] ?? 'bg-amber-100 text-amber-700';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wide {{ $colorClass }}">
                                    {{ $log->action }}
                                </span>
                            </td>

                            {{-- Modul --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                    {{ $log->module }}
                                </span>
                            </td>

                            {{-- Deskripsi --}}
                            <td class="px-5 py-4 text-gray-500 max-w-xs truncate" title="{{ $log->description }}">
                                {{ $log->description }}
                            </td>

                            {{-- IP --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="font-mono text-xs text-gray-500">{{ $log->ip_address }}</span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Empty State --}}
        @if($logs->isEmpty())
            <div class="py-16 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-400 text-sm">Belum ada aktivitas yang tercatat.</p>
            </div>
        @endif

        {{-- Pagination --}}
        @if($logs->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $logs->links() }}
            </div>
        @endif

    </div>

</div>
@endsection