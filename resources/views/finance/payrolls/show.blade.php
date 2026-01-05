<h3>Payroll {{ $payroll->period }}</h3>

<table class="table">
<tr>
    <th>Karyawan</th>
    <th>Total Gaji</th>
</tr>

@foreach($items as $i)
<tr>
    <td>{{ $i->employee->user->name }}</td>
    <td>{{ number_format($i->total_salary,2) }}</td>
</tr>
@endforeach
<tr>
    <th>Total</th>
    <th>{{ number_format($total,2) }}</th>
</tr>
</table>

@if($payroll->status === 'draft')
<form method="POST" action="{{ route('finance.payrolls.approve',$payroll->id) }}">
@csrf
<button class="btn btn-success">Approve Payroll</button>
</form>
@endif

@if($payroll->status === 'approved')
<form method="POST" action="{{ route('finance.payrolls.paid',$payroll->id) }}">
@csrf
<button class="btn btn-primary">Mark as Paid</button>
</form>
@endif
