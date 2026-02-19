@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">

    <a href="{{ route('staff.tasks.index') }}"
       class="text-sm text-gray-500 hover:underline">&larr; Kembali</a>

    <h1 class="text-2xl font-bold mt-2 mb-4">{{ $task->title }}</h1>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <p class="mb-2"><strong>Project:</strong> {{ $task->project->name }}</p>
        <p class="mb-2"><strong>Status:</strong>
            <span class="px-2 py-1 rounded text-xs bg-gray-200">
                {{ ucfirst(str_replace('_',' ',$task->status)) }}
            </span>
        </p>
        <p class="mb-2"><strong>Deadline:</strong>
            {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}
        </p>

        <div class="mt-4">
            <strong>Deskripsi:</strong>
            <p class="text-gray-700 mt-1">
                {{ $task->description ?? '-' }}
            </p>
        </div>
    </div>

    {{-- FORM UPDATE STATUS --}}
    @if(in_array($task->status, ['queue','revision','in_progress']))
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="font-semibold mb-4">Update Status</h2>

        <form method="POST" action="{{ route('staff.tasks.update-status', $task->id) }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm mb-1">PR Link (Opsional)</label>
                <input type="text" name="pr_link"
                       value="{{ $task->pr_link }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Catatan</label>
                <textarea name="note"
                          class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="flex gap-3">

                @if($task->status === 'queue' || $task->status === 'revision')
                    <button type="submit"
                            name="status"
                            value="in_progress"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                        Mulai Kerjakan
                    </button>
                @endif

                @if($task->status === 'in_progress')
                    <button type="submit"
                            name="status"
                            value="submitted"
                            class="bg-green-600 text-white px-4 py-2 rounded">
                        Ajukan
                    </button>
                @endif

            </div>
        </form>
    </div>
    @endif

    {{-- HISTORI REVIEW --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="font-semibold mb-4">Histori</h2>

        @forelse($task->reviews as $review)
            <div class="border-b pb-3 mb-3">
                <p class="text-sm text-gray-500">
                    {{ $review->created_at->format('d M Y H:i') }}
                </p>
                <p class="font-medium">
                    {{ ucfirst($review->action) }}
                    oleh {{ $review->reviewer->name }}
                </p>
                <p class="text-gray-700">
                    {{ $review->note ?? '-' }}
                </p>
            </div>
        @empty
            <p class="text-gray-500 text-sm">Belum ada histori.</p>
        @endforelse
    </div>

</div>
@endsection