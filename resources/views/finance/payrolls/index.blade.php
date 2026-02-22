@extends('layouts.finance')

@section('title', 'Payroll Approval')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Payroll Approval</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan setujui payroll karyawan</p>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Periode</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Dibuat Oleh</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($payrolls as $p)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">{{ $p->period }}</td>
                        <td class="px-4 py-3 text-sm">
                            @php
                                $statusColor = match($p->status) {
                                    'approved' => 'bg-green-100 text-green-700',
                                    'paid'     => 'bg-blue-100 text-blue-700',
                                    'pending'  => 'bg-amber-100 text-amber-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                    default    => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }} capitalize">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">{{ $p->generator->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('finance.payrolls.show', $p->id) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors whitespace-nowrap">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-sm text-gray-400">Belum ada data payroll.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection