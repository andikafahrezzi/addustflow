{{-- resources/views/manager/tasks/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">{{ $task->title }}</h1>

    <div class="bg-white shadow rounded-xl p-6 mb-6">
        <p class="mb-2"><strong>Project:</strong> {{ $task->project->name }}</p>
        <p class="mb-2"><strong>Assignee:</strong> {{ $task->assignee->name }}</p>
        <p class="mb-2"><strong>Status:</strong> {{ ucfirst(str_replace('_',' ', $task->status)) }}</p>

        <p class="mt-4"><strong>Repo:</strong></p>
        <p class="text-gray-600">{{ $task->project->repository_url }}</p>
        <p class="mt-4"><strong>Deskripsi:</strong></p>
        <p class="text-gray-600">{{ $task->description }}</p>

        @if($task->pr_link)
            <p class="mt-4">
                <strong>PR Link:</strong>
                <a href="{{ $task->pr_link }}" target="_blank"
                   class="text-indigo-600 hover:underline">
                    Lihat Pull Request
                </a>
            </p>
        @endif
    </div>

    {{-- Action Buttons --}}
    @if($task->status === 'submitted')
        <div class="flex gap-6 mb-6">

            {{-- Approve --}}
            <form method="POST" action="{{ route('manager.tasks.approve', $task->id) }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Approve
                </button>
            </form>

            {{-- Revision --}}
            <form method="POST" action="{{ route('manager.tasks.revision', $task->id) }}" class="flex-1">
                @csrf
                <textarea name="note" rows="2"
                    placeholder="Alasan revisi..."
                    class="w-full border rounded-lg p-2 mb-2"></textarea>

                @error('note')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Kirim Revisi
                </button>
            </form>

        </div>
    @endif

    {{-- Review History --}}
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-lg font-semibold mb-4">Riwayat Aktivitas</h2>

        <div class="space-y-3">
            @forelse($task->reviews as $review)
                <div class="border rounded-lg p-3 text-sm">
                    <p>
                        <strong>{{ $review->reviewer->name }}</strong>
                        melakukan
                        <strong>{{ ucfirst($review->action) }}</strong>
                    </p>

                    @if($review->note)
                        <p class="text-gray-600 mt-1">
                            "{{ $review->note }}"
                        </p>
                    @endif

                    <p class="text-xs text-gray-400 mt-1">
                        {{ $review->created_at->format('d M Y H:i') }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada aktivitas.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection