
<div class="container">
    <h3>Projects</h3>
    <a href="{{ route('manager.projects.create') }}" class="btn btn-primary mb-3">Buat Project</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Project</th>
                <th>Client</th>
                <th>Contract Value</th>
                <th>Budget</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->client->name }}</td>
                <td>{{ number_format($p->contract_value) }}</td>
                <td>{{ number_format($p->budget) }}</td>
                <td>{{ $p->status }}</td>
                <td>
                    <a href="{{ route('manager.projects.members.index',$p->id) }}" class="btn btn-warning btn-sm">Anggota</a>
                    <a href="{{ route('manager.projects.expenses.index',$p->id) }}" class="btn btn-warning btn-sm">expenses</a>
                    <a href="{{ route('manager.invoices.index',$p->id) }}" class="btn btn-warning btn-sm">Invoices</a>
                    <a href="{{ route('manager.projects.edit',$p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('manager.projects.destroy',$p->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
</div>

