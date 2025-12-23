
<div class="container">
    <h3>Project Detail</h3>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Proposal:</strong> {{ $project->proposal->title }}</li>
        <li class="list-group-item"><strong>Lead:</strong> {{ $project->proposal->lead->name }}</li>
        <li class="list-group-item"><strong>Start:</strong> {{ $project->start_date }}</li>
        <li class="list-group-item"><strong>End:</strong> {{ $project->end_date ?? '-' }}</li>
        <li class="list-group-item"><strong>Budget:</strong> Rp {{ number_format($project->budget,0,',','.') }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($project->status) }}</li>
    </ul>

    <a href="{{ route('manager.projects.index') }}" class="btn btn-secondary">Back</a>
</div>

