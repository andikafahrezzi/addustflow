{{-- resources/views/manager/tasks/show.blade.php --}}
@extends('layouts.manager')

@section('title', $task->title)
@section('breadcrumb', 'Tasks / Detail Task')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h1>
            <p class="text-sm text-gray-500 mt-1">Detail dan riwayat aktivitas task</p>
        </div>
        <a href="{{ route('manager.tasks.index') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition whitespace-nowrap">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Task Detail Card --}}
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5 sm:p-8 mb-6 max-w-4xl">

        {{-- Info Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Project</p>
                <p class="text-sm font-semibold text-gray-800">{{ $task->project->name }}</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Assignee</p>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-emerald-700 text-xs font-bold">
                            {{ strtoupper(substr($task->assignee->name, 0, 1)) }}
                        </span>
                    </div>
                    <p class="text-sm font-semibold text-gray-800">{{ $task->assignee->name }}</p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Status</p>
                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full
                    @if($task->status == 'submitted') bg-yellow-100 text-yellow-700
                    @elseif($task->status == 'done') bg-green-100 text-green-700
                    @elseif($task->status == 'revision') bg-red-100 text-red-700
                    @elseif($task->status == 'in_progress') bg-blue-100 text-blue-700
                    @else bg-gray-100 text-gray-600
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                </span>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Repository</p>
                <p class="text-sm text-gray-600 break-all">{{ $task->project->repository_url }}</p>
            </div>

        </div>

        {{-- Deskripsi --}}
        <div class="mb-6">
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-2">Deskripsi</p>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-700 leading-relaxed">{{ $task->description }}</p>
            </div>
        </div>

        {{-- PR Link --}}
        @if($task->pr_link)
            <div class="flex items-center gap-2 p-4 bg-indigo-50 border border-indigo-100 rounded-lg">
                <svg class="w-4 h-4 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
                <span class="text-sm text-gray-600 font-medium">Pull Request:</span>
                <a href="{{ $task->pr_link }}" target="_blank"
                   class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline break-all transition">
                    Lihat Pull Request
                </a>
            </div>
        @endif

    </div>

    {{-- Action Buttons (hanya jika status submitted) --}}
    @if($task->status === 'submitted')
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5 sm:p-8 mb-6 max-w-4xl">
            <h2 class="text-base font-semibold text-gray-800 mb-4">Tindakan Review</h2>

            <div class="flex flex-col sm:flex-row gap-4">

                {{-- Approve --}}
                <form method="POST" action="{{ route('manager.tasks.approve', $task->id) }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Approve
                    </button>
                </form>

                {{-- Revision --}}
                <form method="POST" action="{{ route('manager.tasks.revision', $task->id) }}" class="flex-1">
                    @csrf
                    <textarea name="note" rows="2"
                        placeholder="Alasan revisi..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition resize-none mb-2"></textarea>

                    @error('note')
                        <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Kirim Revisi
                    </button>
                </form>

            </div>
        </div>
    @endif

    {{-- Review History --}}
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5 sm:p-8 max-w-4xl">
        <h2 class="text-base font-semibold text-gray-800 mb-4">Riwayat Aktivitas</h2>

        <div class="space-y-3">
            @forelse($task->reviews as $review)
                <div class="flex gap-3">
                    {{-- Timeline dot --}}
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                            @if($review->action == 'approved') bg-green-100
                            @elseif($review->action == 'revision') bg-red-100
                            @else bg-gray-100
                            @endif">
                            @if($review->action == 'approved')
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            @elseif($review->action == 'revision')
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @endif
                        </div>
                        {{-- Connector line --}}
                        @if(!$loop->last)
                            <div class="w-px flex-1 bg-gray-200 my-1"></div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 pb-4">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-sm text-gray-800">
                                <span class="font-semibold">{{ $review->reviewer->name }}</span>
                                melakukan
                                <span class="font-semibold">{{ ucfirst($review->action) }}</span>
                            </p>

                            @if($review->note)
                                <p class="text-sm text-gray-600 mt-1 italic">
                                    "{{ $review->note }}"
                                </p>
                            @endif

                            <p class="text-xs text-gray-400 mt-1.5">
                                {{ $review->created_at->format('d M Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-400">
                    <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-sm">Belum ada aktivitas.</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection