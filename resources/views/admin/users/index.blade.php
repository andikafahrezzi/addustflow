<h2>Manajemen User</h2>

<a href="{{ route('admin.users.create') }}">+ Tambah User</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Aksi</th>

    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name }}</td>
            <td>
                @if($user->is_active)
                    <span style="color:green">Aktif</span>
                @else
                    <span style="color:red">Nonaktif</span>
                @endif
            </td>

            <td>
                <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>

                <form action="{{ route('admin.users.toggle-status', $user->id) }}"
                    method="POST"
                    style="display:inline">
                    @csrf
                    @method('PATCH')

                    <button type="submit">
                        {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>

                <form action="{{ route('admin.users.destroy', $user->id) }}"
                    method="POST"
                    style="display:inline"
                    onsubmit="return confirm('Yakin hapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
