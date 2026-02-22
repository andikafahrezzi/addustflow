@extends('layouts.finance')

@section('title', 'Detail Invoice - ' . $invoice->invoice_number)

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Detail Invoice</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $invoice->invoice_number }}</p>
    </div>

    {{-- Invoice Info Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 space-y-3">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider">Project</p>
                <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $project->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider">Status</p>
                <div class="mt-0.5">
                    @php
                        $statusColor = match($invoice->status) {
                            'approved' => 'bg-green-100 text-green-700',
                            'paid'     => 'bg-blue-100 text-blue-700',
                            'sent'     => 'bg-indigo-100 text-indigo-700',
                            'draft'    => 'bg-gray-100 text-gray-600',
                            default    => 'bg-amber-100 text-amber-700',
                        };
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }} capitalize">
                        {{ $invoice->status }}
                    </span>
                </div>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider">Total Amount</p>
                <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ number_format($invoice->amount, 2) }}</p>
            </div>
            @if($invoice->notes)
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider">Notes</p>
                <p class="text-sm text-gray-700 mt-0.5">{{ $invoice->notes }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Expenses Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-700">Expenses <span class="text-xs font-normal text-gray-400 ml-1">(Read Only)</span></h2>
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
                    @forelse($expenses as $ex)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $ex->description }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">{{ number_format($ex->amount, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-4 py-8 text-center text-sm text-gray-400">Tidak ada expense.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-3">
        @if($invoice->status === 'draft')
            <form action="{{ route('finance.invoices.approve', $invoice->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                    Approve
                </button>
            </form>

        @elseif($invoice->status === 'approved')
            <form action="{{ route('finance.invoices.send', $invoice->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium rounded-lg transition-colors">
                    Send to Client
                </button>
            </form>

        @elseif($invoice->status === 'sent')
            <form action="{{ route('finance.invoices.paid', $invoice->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    Mark as Paid
                </button>
            </form>
        @endif
    </div>

</div>
@endsection