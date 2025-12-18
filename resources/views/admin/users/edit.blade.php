<h2>Edit User</h2>

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div>
        <label>Nama</label><br>
        <input type="text" name="name" value="{{ $user->name }}" required>
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ $user->email }}" required>
    </div>

    <div>
        <label>Password (kosongkan jika tidak diubah)</label><br>
        <input type="password" name="password">
    </div>

    <div>
        <label>Role</label><br>
        <select name="role_id" required>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" 
                    {{ $user->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Update</button>
</form>
