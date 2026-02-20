{{-- resources/views/manager/tasks/index.blade.php --}}
@extends('layouts.manager')

@section('title', 'Daftar Task')
@section('breadcrumb', 'Tasks')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Task Project</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola semua task dari setiap project</p>
        </div>
        <a href="{{ route('manager.tasks.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm whitespace-nowrap">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Task
        </a>
    </div>

    {{-- Desktop Table (hidden on mobile) --}}
    <div class="hidden md:block bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Project</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Task</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Assignee</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($tasks as $task)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $task->project->name }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $task->title }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $task->assignee->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                    @if($task->status == 'submitted') bg-yellow-100 text-yellow-700
                                    @elseif($task->status == 'done') bg-green-100 text-green-700
                                    @elseif($task->status == 'revision') bg-red-100 text-red-700
                                    @elseif($task->status == 'in_progress') bg-blue-100 text-blue-700
                                    @else bg-gray-100 text-gray-600
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('manager.tasks.show', $task->id) }}"
                                   class="inline-flex items-center text-emerald-600 hover:text-emerald-800 font-medium transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Tidak ada tasks ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Card View (hidden on desktop) --}}
    <div class="md:hidden space-y-3">
        @forelse($tasks as $task)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                {{-- Card Header --}}
                <div class="flex items-start justify-between gap-2 mb-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $task->title }}</p>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $task->project->name }}</p>
                    </div>
                    <span class="flex-shrink-0 px-2.5 py-1 text-xs font-medium rounded-full
                        @if($task->status == 'submitted') bg-yellow-100 text-yellow-700
                        @elseif($task->status == 'done') bg-green-100 text-green-700
                        @elseif($task->status == 'revision') bg-red-100 text-red-700
                        @elseif($task->status == 'in_progress') bg-blue-100 text-blue-700
                        @else bg-gray-100 text-gray-600
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </div>

                {{-- Card Body --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xs text-gray-500">
                        <svg class="w-3.5 h-3.5 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $task->assignee->name ?? 'Unassigned' }}
                    </div>
                    <a href="{{ route('manager.tasks.show', $task->id) }}"
                       class="inline-flex items-center px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-medium rounded-lg transition">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center text-gray-400">
                <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Tidak ada tasks ditemukan.
            </div>
        @endforelse
    </div>

@endsection