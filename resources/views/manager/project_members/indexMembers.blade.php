
<div class="container">
    <h3>Projects</h3>
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
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
</div>

