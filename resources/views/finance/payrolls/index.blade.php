<h3>Payroll Approval</h3>

<table class="table">
<tr>
    <th>Periode</th>
    <th>Status</th>
    <th>Dibuat Oleh</th>
    <th>Aksi</th>
</tr>

@foreach($payrolls as $p)
<tr>
    <td>{{ $p->period }}</td>
    <td>{{ $p->status }}</td>
    <td>{{ $p->generator->name ?? '-' }}</td>
    <td>
        <a href="{{ route('finance.payrolls.show',$p->id) }}"
           class="btn btn-sm btn-primary">
           Detail
        </a>
    </td>
</tr>
@endforeach
</table>
