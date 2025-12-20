
<h1>Leads</h1>
<a href="{{ route('marketing.leads.create') }}" class="btn btn-primary">Tambah Lead</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Client</th>
            <th>Title</th>
            <th>Source</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leads as $lead)
        <tr>
            <td>{{ $lead->client->name }}</td>
            <td>{{ $lead->title }}</td>
            <td>{{ $lead->source }}</td>
            <td>{{ ucfirst($lead->status) }}</td>
            <td>
                <a href="{{ route('marketing.leads.edit', $lead) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('marketing.leads.destroy', $lead) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus lead?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $leads->links() }}

