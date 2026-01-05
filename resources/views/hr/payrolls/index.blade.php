<h3>Payroll</h3>
<a href="{{ route('hr.payrolls.create') }}" class="btn btn-primary">Buat Payroll</a>

<table class="table mt-3">
@foreach($payrolls as $p)
<tr>
    <td>{{ $p->period }}</td>
    <td>{{ $p->status }}</td>
    <td>
        <a href="{{ route('hr.payrolls.show',$p->id) }}">Detail</a>
    </td>
</tr>
@endforeach
</table>
