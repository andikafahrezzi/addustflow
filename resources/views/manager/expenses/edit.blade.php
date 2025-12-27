<h3>Edit Expense for Project: {{ $project->name }}</h3>

<form action="{{ route('manager.projects.expenses.update', [$project->id, $expense->id]) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Project</label>
        <input type="text" class="form-control" value="{{ $project->name }}" readonly>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <input type="text" name="description" class="form-control"
               value="{{ $expense->description }}" required>
    </div>

    <div class="mb-3">
        <label>Amount</label>
        <input type="number" name="amount" class="form-control"
               value="{{ $expense->amount }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
