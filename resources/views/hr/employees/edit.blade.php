<h3>Edit Karyawan</h3>

<form action="{{ route('hr.employees.update', $employee->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" class="form-control" value="{{ $employee->user->name }}" disabled>
    </div>

    <div class="mb-3">
        <label>Posisi</label>
        <input type="text" name="position" class="form-control" value="{{ $employee->position }}" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Bergabung</label>
        <input type="date" name="join_date" class="form-control" value="{{ $employee->join_date }}" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="active" {{ $employee->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $employee->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('hr.employees.index') }}" class="btn btn-secondary">Kembali</a>
</form>
