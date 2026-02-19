{{-- resources/views/manager/tasks/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Task Project</h1>
    <a href="{{ route('manager.tasks.create') }}" class="btn btn-primary mb-3">Tambah Task</a>


    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Project</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Task</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Assignee</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($tasks as $task)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">
                            {{ $task->project->name }}
                        </td>
                        <td class="px-4 py-3 text-sm font-medium">
                            {{ $task->title }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $task->assignee->name ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($task->status == 'submitted') bg-yellow-100 text-yellow-700
                                @elseif($task->status == 'done') bg-green-100 text-green-700
                                @elseif($task->status == 'revision') bg-red-100 text-red-700
                                @elseif($task->status == 'in_progress') bg-blue-100 text-blue-700
                                @else bg-gray-100 text-gray-700
                                @endif
                            ">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('manager.tasks.show', $task->id) }}"
                               class="text-indigo-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada tasks.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection