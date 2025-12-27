<h3>Daftar Project</h3>

<table class="table">
    <tr>
        <th>Nama Project</th>
        <th>Manager</th>
        <th>Budget</th>
        <th>Aksi</th>
    </tr>

    @foreach($projects as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->manager->name ?? '-' }}</td>
        <td>{{ number_format($p->budget, 2) }}</td>

        <td>
            <a href="{{ route('finance.projects.show', $p->id) }}"
                class="btn btn-primary btn-sm">Detail</a>
        </td>
    </tr>
    @endforeach
</table>
