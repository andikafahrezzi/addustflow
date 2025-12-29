<h3>Tambah Karyawan</h3>

<form action="{{ route('hr.employees.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>User</label>
        <select name="user_id" class="form-control" required>
            <option value="">-- pilih user --</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Posisi</label>
        <input type="text" name="position" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Bergabung</label>
        <input type="date" name="join_date" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('hr.employees.index') }}" class="btn btn-secondary">Kembali</a>
</form>
