@extends('layouts.finance')

@section('title', 'Expenses - ' . $project->name)

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Expenses</h1>
            <p class="text-sm text-gray-500 mt-1">Project: {{ $project->name }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <form action="{{ route('finance.expenses.approveAll', $project->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                    Approve All
                </button>
            </form>
            <form action="{{ route('finance.expenses.rejectAll', $project->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                    Reject All
                </button>
            </form>
        </div>
    </div>

    {{-- Expenses Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($project->expenses as $exp)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $exp->description }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">{{ number_format($exp->amount, 2) }}</td>
                        <td class="px-4 py-3 text-sm">
                            @php
                                $statusColor = match($exp->status) {
                                    'approved' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                    'pending'  => 'bg-amber-100 text-amber-700',
                                    default    => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }} capitalize">
                                {{ $exp->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($exp->status == 'pending')
                                <div class="flex flex-wrap gap-2">
                                    <form action="{{ route('finance.expenses.approve', $exp->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-colors whitespace-nowrap">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('finance.expenses.reject', $exp->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors whitespace-nowrap">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                    Done
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-sm text-gray-400">Belum ada expenses.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection