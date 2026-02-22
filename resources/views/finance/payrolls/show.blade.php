@extends('layouts.finance')

@section('title', 'Detail Payroll - ' . $payroll->period)

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Payroll</h1>
        <p class="text-sm text-gray-500 mt-1">Periode: {{ $payroll->period }}</p>
    </div>

    {{-- Payroll Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Karyawan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Total Gaji</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($items as $i)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $i->employee->user->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">{{ number_format($i->total_salary, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50 border-t-2 border-gray-200">
                    <tr>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">Total</td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800 whitespace-nowrap">{{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-3">
        @if($payroll->status === 'draft')
            <form method="POST" action="{{ route('finance.payrolls.approve', $payroll->id) }}">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                    Approve Payroll
                </button>
            </form>
        @endif

        @if($payroll->status === 'approved')
            <form method="POST" action="{{ route('finance.payrolls.paid', $payroll->id) }}">
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