
<div class="container">
    <h3>Daftar Proposal Submitted</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Client</th>
                <th>Estimated Value</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proposals as $proposal)
                <tr>
                    <td>{{ $proposal->title }}</td>
                    <td>{{ $proposal->lead->client->name }}</td>
                    <td>Rp {{ number_format($proposal->estimated_value, 0, ',', '.') }}</td>
                    <td>{{ $proposal->lead->creator->name ?? '-' }}</td>

                    <td>
                        <form action="{{ route('manager.proposals.approve', $proposal->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>

                        <form action="{{ route('manager.proposals.reject', $proposal->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

