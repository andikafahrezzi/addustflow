@extends('layouts.finance')

@section('title', 'Daftar Project')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Project</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola semua project dan invoice terkait</p>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Nama Project
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Manager
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Budget
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($projects as $p)
                    @php
                        $clientInvoice = $p->invoices
                            ->whereIn('status', ['approved', 'paid', 'sent'])
                            ->sortByDesc('created_at')->first();
                    @endphp
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                            {{ $p->name }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">
                            {{ $p->manager->name ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">
                            {{ number_format($p->budget, 2) }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('finance.invoices.index', $p->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors whitespace-nowrap">
                                    Invoice Internal
                                </a>

                                @if($clientInvoice)
                                <a href="{{ route('finance.payments.index', $clientInvoice->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-colors whitespace-nowrap">
                                    Buat Invoice Client
                                </a>

                                <a href="{{ route('finance.invoices.showClient', $clientInvoice->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg transition-colors whitespace-nowrap">
                                    Lihat Invoice Client
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-sm text-gray-400">
                            Belum ada project tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection