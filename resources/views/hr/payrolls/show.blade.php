<h3>Payroll {{ $payroll->period }}</h3>

<table class="table">
<tr>
<th>Karyawan</th>
<th>Base</th>
<th>Total</th>
<th>Aksi</th>
</tr>

@foreach($items as $i)
<tr>
<td>{{ $i->employee->user->name }}</td>
<td>{{ number_format($i->base_salary,2) }}</td>
<td>{{ number_format($i->total_salary,2) }}</td>
<td>
<a href="{{ route('hr.payroll-items.edit',$i->id) }}">Edit</a>
</td>
</tr>
@endforeach
</table>
