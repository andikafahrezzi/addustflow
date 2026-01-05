<form method="POST" action="{{ route('hr.payrolls.store') }}">
    @csrf
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif
    
    <div class="mb-3">
        <label class="form-label">Periode (YYYY-MM)</label>
        <input type="month" 
               name="period" 
               class="form-control" 
               value="{{ old('period', date('Y-m')) }}"
               required>
        <small class="text-muted">
            Jika payroll untuk periode ini sudah ada, hanya employee baru yang akan ditambahkan.
        </small>
    </div>
    
    <!-- Tampilkan info jika payroll sudah ada -->
    @php
        $currentPeriod = date('Y-m');
        $existingPayroll = \App\Models\Payroll::where('period', $currentPeriod)->first();
    @endphp
    
    @if($existingPayroll)
        <div class="alert alert-warning">
            <strong>Info:</strong> Payroll untuk {{ $currentPeriod }} sudah ada.
            <a href="{{ route('hr.payrolls.show', $existingPayroll->id) }}" class="btn btn-sm btn-outline-primary ms-2">
                Lihat Payroll
            </a>
        </div>
    @endif
    
    <button type="submit" class="btn btn-primary mt-2">Generate Payroll</button>
    <a href="{{ route('hr.payrolls.index') }}" class="btn btn-secondary mt-2">Kembali</a>
</form>
<!-- Tampilkan info jika ada payroll di bulan ini atau bulan lalu -->
@php
    $thisMonth = date('Y-m');
    $lastMonth = date('Y-m', strtotime('-1 month'));
    
    $existingThisMonth = \App\Models\Payroll::where('period', $thisMonth)->first();
    $existingLastMonth = \App\Models\Payroll::where('period', $lastMonth)->first();
@endphp

@if($existingThisMonth || $existingLastMonth)
<div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-4">
    <h4 class="font-medium text-yellow-800">Info:</h4>
    <ul class="text-sm text-yellow-700 mt-1">
        @if($existingThisMonth)
        <li>• Payroll {{ $thisMonth }} sudah ada (Status: {{ $existingThisMonth->status }})</li>
        @endif
        @if($existingLastMonth)
        <li>• Payroll {{ $lastMonth }} sudah ada (Status: {{ $existingLastMonth->status }})</li>
        @endif
    </ul>
</div>
@endif