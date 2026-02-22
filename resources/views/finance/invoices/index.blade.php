@extends('layouts.finance')

@section('title', 'Invoices - ' . $project->name)

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Invoices for Project</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $project->name }}</p>
        </div>
        <form method="POST" action="{{ route('finance.invoices.approveAll', $project->id) }}">
            @csrf @method('PUT')
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                Approve All
            </button>
        </form>
    </div>

    {{-- Expenses Summary --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-700">Expenses Summary <span class="text-xs font-normal text-gray-400 ml-1">(Read Only)</span></h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($expenses as $exp)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $exp->description }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">{{ number_format($exp->amount, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-4 py-8 text-center text-sm text-gray-400">Tidak ada expense.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex justify-end">
            <span class="text-sm font-semibold text-gray-700">Total Expenses: {{ number_format($total, 2) }}</span>
        </div>
    </div>

    {{-- Invoices Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-700">Daftar Invoice</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Invoice #</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($invoices as $inv)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">{{ $inv->invoice_number }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">{{ number_format($inv->amount, 2) }}</td>
                        <td class="px-4 py-3 text-sm">
                            @php
                                $statusColor = match($inv->status) {
                                    'approved' => 'bg-green-100 text-green-700',
                                    'paid'     => 'bg-blue-100 text-blue-700',
                                    'sent'     => 'bg-indigo-100 text-indigo-700',
                                    'pending'  => 'bg-amber-100 text-amber-700',
                                    default    => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }} capitalize">
                                {{ $inv->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('finance.invoices.approve', $inv->id) }}">
                                @csrf @method('PUT')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-colors whitespace-nowrap">
                                    Approve
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-400">Belum ada invoice untuk project ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection