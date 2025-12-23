
<div class="container">
    <h3>Buat Project</h3>

    <form action="{{ route('manager.projects.store') }}" method="POST">
        @csrf

    <div class="mb-3">
        <label>Pilih Proposal</label>
        <select id="proposal-select" name="proposal_id" class="form-control" required>
            <option value="">-- pilih proposal --</option>
            @foreach($proposals as $item)
                <option 
                    value="{{ $item->id }}"
                    data-estimated="{{ $item->estimated_value }}">
                    {{ $item->title }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label>Estimated Value</label>
        <input type="number" id="estimated-value" class="form-control" readonly>
    </div>

        <div class="mb-3">
            <label>Budget Project</label>
            <input type="number" name="budget" class="form-control" required>
        </div>

        <div class="row">
            <div class="col">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="col">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>

        <button class="btn btn-primary mt-3">Simpan</button>
    </form>
    <script>
document.getElementById('proposal-select').addEventListener('change', function () {
    const estimated = this.selectedOptions[0].dataset.estimated || "";
    document.getElementById('estimated-value').value = estimated;
});
</script>

</div>

