<h3>Invoices for Project: {{ $project->name }}</h3>

<a href="{{ route('manager.invoices.create', $project->id) }}" class="btn btn-primary">
    + Create Invoice
</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Invoice #</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Created</th>
        </tr>
    </thead>

    <tbody>
        @forelse($invoices as $inv)
        <tr>
            <td>{{ $inv->invoice_number }}</td>
            <td>{{ number_format($inv->amount, 2) }}</td>
            <td>{{ $inv->status }}</td>
            <td>{{ $inv->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No invoices yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
