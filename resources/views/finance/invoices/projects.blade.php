<h3>All Projects</h3>

<table class="table">
    <thead>
        <tr>
            <th>Project</th>
            <th>Invoices</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->name }}</td>
            <td>{{ $project->invoices->count() }}</td>
            <td>
                <a href="{{ route('finance.invoices.index', $project->id) }}" class="btn btn-primary">
                    View Invoices
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
