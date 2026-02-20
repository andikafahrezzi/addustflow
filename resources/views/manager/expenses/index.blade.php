{{-- resources/views/manager/projects/expenses/index.blade.php --}}
@extends('layouts.manager')

@section('title', 'Expenses')
@section('breadcrumb', 'Projects / Expenses')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Expenses</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $project->name }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('manager.projects.expenses.create', $project->id) }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Expense
            </a>
            <a href="{{ route('manager.projects.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    @if($expenses->count() == 0)
        {{-- Empty State --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 px-5 py-12 text-center text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-sm">Belum ada expenses untuk project ini.</p>
        </div>
    @else

        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($expenses as $exp)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $exp->description }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">Rp {{ number_format($exp->amount, 2) }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                        @if($exp->status == 'approved') bg-green-100 text-green-700
                                        @elseif($exp->status == 'rejected') bg-red-100 text-red-700
                                        @elseif($exp->status == 'pending') bg-yellow-100 text-yellow-700
                                        @else bg-gray-100 text-gray-600
                                        @endif">
                                        {{ ucfirst($exp->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('manager.projects.expenses.edit', [$project->id, $exp->id]) }}"
                                           class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-medium rounded-lg transition">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('manager.projects.expenses.destroy', [$project->id, $exp->id]) }}"
                                              method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Hapus expense ini?')"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-medium rounded-lg transition">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Card View --}}
        <div class="md:hidden space-y-3">
            @foreach($expenses as $exp)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">

                    {{-- Card Header --}}
                    <div class="flex items-start justify-between gap-2 mb-3">
                        <p class="text-sm font-medium text-gray-800 flex-1">{{ $exp->description }}</p>
                        <span class="flex-shrink-0 px-2.5 py-1 text-xs font-medium rounded-full
                            @if($exp->status == 'approved') bg-green-100 text-green-700
                            @elseif($exp->status == 'rejected') bg-red-100 text-red-700
                            @elseif($exp->status == 'pending') bg-yellow-100 text-yellow-700
                            @else bg-gray-100 text-gray-600
                            @endif">
                            {{ ucfirst($exp->status) }}
                        </span>
                    </div>

                    {{-- Amount --}}
                    <div class="bg-gray-50 rounded-lg px-3 py-2 mb-3">
                        <p class="text-xs text-gray-400">Amount</p>
                        <p class="text-sm font-semibold text-gray-700">Rp {{ number_format($exp->amount, 2) }}</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-2 pt-3 border-t border-gray-100">
                        <a href="{{ route('manager.projects.expenses.edit', [$project->id, $exp->id]) }}"
                           class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-medium rounded-lg transition">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('manager.projects.expenses.destroy', [$project->id, $exp->id]) }}"
                              method="POST" class="flex-1">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus expense ini?')"
                                    class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-medium rounded-lg transition">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>

    @endif

@endsection