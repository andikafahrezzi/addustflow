@extends('layouts.finance')

@section('title', 'Tambah Payment - Invoice #' . $invoice->invoice_number)

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Payment</h1>
        <p class="text-sm text-gray-500 mt-1">Invoice #{{ $invoice->invoice_number }}</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-lg">
        <form action="{{ route('finance.payments.store', $invoice->id) }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                <input type="number" name="amount" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pembayaran</label>
                <input type="date" name="payment_date" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                <input type="text" name="method"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                    class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    Simpan
                </button>
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>
@endsection