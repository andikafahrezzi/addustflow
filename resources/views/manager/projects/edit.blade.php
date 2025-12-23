<div class="container">
    <h3>Edit Project</h3>

    <form action="{{ route('manager.projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- PROPOSAL --}}
        <div class="mb-3">
            <label>Pilih Proposal</label>
            <select id="proposal-edit" name="proposal_id" class="form-control" required>
                @foreach($proposals as $item)
                    <option 
                        value="{{ $item->id }}"
                        data-estimated="{{ $item->estimated_value }}"
                        {{ $item->id == $project->proposal_id ? 'selected' : '' }}>
                        {{ $item->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- estimated value --}}
        <div class="mb-3">
            <label>Estimated Value</label>
            <input 
                type="number" 
                id="estimated-edit" 
                class="form-control" 
                value="{{ $project->proposal->estimated_value }}" 
                readonly>
        </div>

        {{-- budget --}}
        <div class="mb-3">
            <label>Budget Project</label>
            <input 
                type="number" 
                name="budget" 
                class="form-control" 
                value="{{ $project->budget }}" 
                required>
        </div>

        {{-- dates --}}
        <div class="row">
            <div class="col">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $project->start_date }}">
            </div>
            <div class="col">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $project->end_date }}">
            </div>
        </div>

        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>

<script>
// Saat halaman pertama kali dibuka, isi estimated berdasarkan selected option
window.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('proposal-edit');
    const estimated = select.selectedOptions[0].dataset.estimated || "";
    document.getElementById('estimated-edit').value = estimated;
});

// Update estimated saat dropdown diganti
document.getElementById('proposal-edit').addEventListener('change', function () {
    const estimated = this.selectedOptions[0].dataset.estimated || "";
    document.getElementById('estimated-edit').value = estimated;
});
</script>
