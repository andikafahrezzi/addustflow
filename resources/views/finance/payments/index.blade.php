@extends('layouts.finance')

@section('title', 'Payments - Invoice #' . $invoice->invoice_number)

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Payments</h1>
            <p class="text-sm text-gray-500 mt-1">Invoice #{{ $invoice->invoice_number }}</p>
        </div>
        <a href="{{ route('finance.payments.create', $invoice->id) }}"
            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
            + Tambah Pembayaran
        </a>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-xs text-gray-500 uppercase tracking-wider">Total Invoice</p>
            <p class="text-xl font-bold text-gray-800 mt-1">{{ number_format($invoice->amount, 2) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <p class="text-xs text-gray-500 uppercase tracking-wider">Total Paid</p>
            <p class="text-xl font-bold text-green-600 mt-1">{{ number_format($totalPaid, 2) }}</p>
        </div>
    </div>

    {{-- Payments Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-700">Riwayat Pembayaran</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Metode</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($payments as $p)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">{{ $p->payment_date }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $p->method ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">{{ number_format($p->amount, 2) }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('finance.payments.destroy', [
                                    'invoice' => $p->invoice_id,
                                    'payment' => $p->id
                                ]) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus payment ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors whitespace-nowrap">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-400">Belum ada pembayaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection