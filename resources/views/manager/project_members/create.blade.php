<div class="container">
    <h3>Tambah Member Project: {{ $project->name }}</h3>

    <form action="{{ route('manager.projects.members.store',$project->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- pilih user --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <input type="text" name="role" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
