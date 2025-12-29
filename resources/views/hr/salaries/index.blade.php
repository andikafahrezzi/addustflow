<h3>Riwayat Gaji: {{ $employee->user->name }}</h3>

<a href="{{ route('hr.salaries.create', $employee->id) }}" class="btn btn-primary">
    Tambah Salary
</a>

<table class="table mt-3">
    <tr>
        <th>Base Salary</th>
        <th>Effective Date</th>
        <th>Aksi</th>
    </tr>

    @foreach($salaries as $s)
    <tr>
        <td>{{ number_format($s->base_salary, 2) }}</td>
        <td>{{ $s->effective_date }}</td>
        <td>
            <a href="{{ route('hr.salaries.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('hr.salaries.destroy', $s->id) }}" 
                  method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
