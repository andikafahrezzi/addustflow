<h3>Add Expense for Project: {{ $project->name }}</h3>

<form action="{{ route('manager.projects.expenses.store', $project->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Project</label>
        <input type="text" class="form-control" value="{{ $project->name }}" readonly>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <input type="text" name="description" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Amount</label>
        <input type="number" name="amount" class="form-control" required>
    </div>

    <button class="btn btn-success">Create</button>
</form>
