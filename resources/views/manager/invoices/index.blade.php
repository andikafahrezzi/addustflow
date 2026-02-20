{{-- resources/views/manager/invoices/index.blade.php --}}
@extends('layouts.manager')

@section('title', 'Invoices')
@section('breadcrumb', 'Projects / Invoices')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Invoices</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $project->name }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('manager.invoices.create', $project->id) }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Invoice
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

    {{-- Desktop Table --}}
    <div class="hidden md:block bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Invoice #</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($invoices as $inv)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $inv->invoice_number }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">Rp {{ number_format($inv->amount, 2) }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                    @if($inv->status == 'paid') bg-green-100 text-green-700
                                    @elseif($inv->status == 'unpaid') bg-red-100 text-red-700
                                    @elseif($inv->status == 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-600
                                    @endif">
                                    {{ ucfirst($inv->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $inv->created_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                No invoices yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Card View --}}
    <div class="md:hidden space-y-3">
        @forelse($invoices as $inv)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">

                {{-- Card Header --}}
                <div class="flex items-start justify-between gap-2 mb-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800">{{ $inv->invoice_number }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $inv->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <span class="flex-shrink-0 px-2.5 py-1 text-xs font-medium rounded-full
                        @if($inv->status == 'paid') bg-green-100 text-green-700
                        @elseif($inv->status == 'unpaid') bg-red-100 text-red-700
                        @elseif($inv->status == 'pending') bg-yellow-100 text-yellow-700
                        @else bg-gray-100 text-gray-600
                        @endif">
                        {{ ucfirst($inv->status) }}
                    </span>
                </div>

                {{-- Amount --}}
                <div class="bg-gray-50 rounded-lg px-3 py-2">
                    <p class="text-xs text-gray-400">Amount</p>
                    <p class="text-sm font-semibold text-gray-700">Rp {{ number_format($inv->amount, 2) }}</p>
                </div>

            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center text-gray-400">
                <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                No invoices yet.
            </div>
        @endforelse
    </div>

@endsection