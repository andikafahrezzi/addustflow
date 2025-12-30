
@extends('layouts.marketing')

@section('title', 'Campaign Dashboard')
@section('page-title', 'Campaign Overview')

@section('content')
<div class="container">

    <h3 class="mb-4">Edit Proposal</h3>

    <form action="{{ route('marketing.proposals.update', $proposal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- Lead -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Lead</label>
                <select name="lead_id" id="leadSelect" class="form-control">
                    @foreach ($leads as $lead)
                        <option value="{{ $lead->id }}"
                            {{ $proposal->lead_id == $lead->id ? 'selected' : '' }}>
                            {{ $lead->client->name }} - ({{ $lead->title ?? 'Lead #' . $lead->id }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Title -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Proposal Title</label>
                <input type="text" name="title" id="titleInput"
                    value="{{ old('title', $proposal->title) }}"
                    class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Proposal Deskripsi</label>
                <input type="text" name="description" id="descriptionInput"
                    value="{{ old('description', $proposal->description) }}"
                    class="form-control">
            </div>
            

            <!-- Estimated Value -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Estimated Value (Rp)</label>
                <input type="number" name="estimated_value"
                    value="{{ old('estimated_value', $proposal->estimated_value) }}"
                    class="form-control">
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    @foreach (['draft','submitted'] as $status)
                        <option value="{{ $status }}"
                            {{ $proposal->status == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <button class="btn btn-primary">Update Proposal</button>

    </form>

</div>

<script>
    // Auto update title when lead changed
    document.getElementById('leadSelect').addEventListener('change', function () {
        let selected = this.options[this.selectedIndex].text;
        document.getElementById('titleInput').value = "Proposal for " + selected;
    });
</script>
@endsection

