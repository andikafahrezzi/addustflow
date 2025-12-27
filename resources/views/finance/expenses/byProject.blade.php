<h3>Project: {{ $project->name }}</h3>

<hr>

<!-- Approve / Reject ALL -->
<form action="{{ route('finance.expenses.approveAll', $project->id) }}" method="POST" style="display:inline;">
    @csrf
    <button class="btn btn-success">Approve ALL</button>
</form>

<form action="{{ route('finance.expenses.rejectAll', $project->id) }}" method="POST" style="display:inline;">
    @csrf
    <button class="btn btn-danger">Reject ALL</button>
</form>

<hr>

<table class="table">
    <tr>
        <th>Description</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @forelse($project->expenses as $exp)
    <tr>
        <td>{{ $exp->description }}</td>
        <td>{{ number_format($exp->amount, 2) }}</td>
        <td>{{ $exp->status }}</td>

        <td>
            @if($exp->status == 'pending')
                <form action="{{ route('finance.expenses.approve', $exp->id) }}"
                    method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-success btn-sm">Approve</button>
                </form>

                <form action="{{ route('finance.expenses.reject', $exp->id) }}"
                    method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
            @else
                <span class="badge bg-secondary">Done</span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center text-muted">Belum ada expenses.</td>
    </tr>
    @endforelse
</table>
