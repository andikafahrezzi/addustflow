<div class="container">
    <h3>All Expenses (Finance Review)</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Project</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Created By</th>
                <th>Status</th>
                <th>Approved By</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($expenses as $e)
            <tr>
                <td>{{ $e->project?->name ?? '-' }}</td>
                <td>{{ $e->description }}</td>
                <td>{{ number_format($e->amount, 0) }}</td>

                <td>{{ $e->creator->name }}</td>

                <td>
                    @if($e->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($e->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>

                <td>{{ $e->approver->name ?? '-' }}</td>

                <td>
                    @if($e->status == 'pending')
                        <form action="{{ route('finance.expenses.approve', $e->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>

                        <form action="{{ route('finance.expenses.reject', $e->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    @else
                        <span class="text-muted">No Actions</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
