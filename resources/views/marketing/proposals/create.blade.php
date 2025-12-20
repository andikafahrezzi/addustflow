
<div class="container">
    <h2>Buat Proposal Baru</h2>

    <form action="{{ route('marketing.proposals.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="lead_id" class="form-label">Lead</label>
            <select name="lead_id" id="lead_id" class="form-control" required>
                <option value="">-- Pilih Lead --</option>
                @foreach($leads as $lead)
                    <option 
                        value="{{ $lead->id }}"
                        data-title="{{ $lead->title ?? 'Lead #' . $lead->id . ' - ' . $lead->client->name }}"
                    >
                        {{ $lead->client->name }} - ({{ $lead->title ?? 'Lead #' . $lead->id }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Judul Proposal</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="estimated_value" class="form-label">Estimasi Nilai (Rp)</label>
            <input type="number" name="estimated_value" id="estimated_value" class="form-control" value="{{ old('estimated_value') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="draft">Draft</option>
                <option value="submitted">Submitted</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Proposal</button>
    </form>
</div>

{{-- JS otomatis mengisi title berdasarkan lead --}}
<script>
document.getElementById('lead_id').addEventListener('change', function() {
    let selected = this.options[this.selectedIndex];
    if (selected) {
        let title = selected.getAttribute('data-title');
        document.getElementById('title').value = title || '';
    }
});
</script>
