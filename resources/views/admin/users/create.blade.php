<h2>Tambah User</h2>

<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <div>
        <label>Nama</label><br>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Role</label><br>
        <select name="role_id" required>
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Simpan</button>
</form>
