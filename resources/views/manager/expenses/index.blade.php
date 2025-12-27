<h3>Expenses for Project: {{ $project->name }}</h3>

<a href="{{ route('manager.projects.expenses.create', $project->id) }}"
   class="btn btn-primary mb-3">Add Expense</a>

@if($expenses->count() == 0)
    <div class="alert alert-info">Belum ada expenses untuk project ini.</div>
@else

<table class="table">
    <tr>
        <th>Description</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($expenses as $exp)
    <tr>
        <td>{{ $exp->description }}</td>
        <td>{{ number_format($exp->amount,2) }}</td>
        <td>{{ $exp->status }}</td>
        <td>
            <a href="{{ route('manager.projects.expenses.edit', [$project->id,$exp->id]) }}"
               class="btn btn-sm btn-warning">Edit</a>

            <form action="{{ route('manager.projects.expenses.destroy', [$project->id,$exp->id]) }}"
                  method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endif
