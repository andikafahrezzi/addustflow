{{-- resources/views/manager/invoices/create.blade.php --}}
@extends('layouts.manager')

@section('title', 'Create Invoice')
@section('breadcrumb', 'Projects / Invoices / Create')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Create Invoice</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $project->name }}</p>
        </div>
        <a href="{{ route('manager.invoices.index', $project->id) }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition whitespace-nowrap">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('manager.invoices.store', $project->id) }}">
        @csrf

        {{-- Expenses Summary --}}
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden mb-6">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="text-base font-semibold text-gray-800">Expenses Summary</h2>
            </div>

            {{-- Desktop Table --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($expenses as $exp)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $exp->description }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">Rp {{ number_format($exp->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile Card View --}}
            <div class="md:hidden divide-y divide-gray-100">
                @foreach($expenses as $exp)
                    <div class="flex items-center justify-between px-4 py-3">
                        <p class="text-sm text-gray-700">{{ $exp->description }}</p>
                        <p class="text-sm font-medium text-gray-800">Rp {{ number_format($exp->amount, 2) }}</p>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Total & Submit --}}
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5 sm:p-8 max-w-2xl">

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Total Amount</label>
                <input type="text"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-500 bg-gray-50 cursor-not-allowed"
                    value="{{ $total }}"
                    readonly>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('manager.invoices.index', $project->id) }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Send Invoice
                </button>
            </div>

        </div>

    </form>

@endsection