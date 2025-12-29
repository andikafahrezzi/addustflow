<h3>Daftar Karyawan</h3>

<a href="{{ route('hr.employees.create') }}" class="btn btn-primary mb-3">
    Tambah Karyawan
</a>

<table class="table">
    <tr>
        <th>Nama</th>
        <th>Posisi</th>
        <th>Tanggal Bergabung</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($employees as $e)
    <tr>
        <td>{{ $e->user->name }}</td>
        <td>{{ $e->position }}</td>
        <td>{{ $e->join_date }}</td>
        <td>{{ $e->status }}</td>

        <td>
            <a href="{{ route('hr.employees.edit', $e->id) }}"
                class="btn btn-warning btn-sm">Edit</a>

            @if($e->status === 'active')
            <form action="{{ route('hr.employees.deactivate', $e->id) }}" method="POST" style="display:inline;">
                @csrf @method('PUT')
                <button class="btn btn-secondary btn-sm">Nonaktifkan</button>
            </form>
            @endif

            <form action="{{ route('hr.employees.destroy', $e->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
