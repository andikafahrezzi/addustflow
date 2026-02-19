@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">Task Saya</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Project</th>
                    <th class="p-3">Judul Task</th>
                    <th class="p-3">Deadline</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr class="border-t">
                        <td class="p-3">{{ $task->project->name }}</td>
                        <td class="p-3">{{ $task->title }}</td>
                        <td class="p-3">
                            {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}
                        </td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs bg-gray-200">
                                {{ ucfirst(str_replace('_',' ',$task->status)) }}
                            </span>
                        </td>
                        <td class="p-3">
                            <a href="{{ route('staff.tasks.show', $task->id) }}"
                               class="text-blue-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            Belum ada task.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection