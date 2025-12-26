<div class="container">
    <h3>Edit Member – {{ $project->name }}</h3>

    <form action="{{ route('manager.projects.members.update',[$project->id,$member->id]) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $u)
                    <option value="{{ $u->id }}"
                        {{ $member->user_id == $u->id ? 'selected' : '' }}>
                        {{ $u->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <input type="text" name="role" class="form-control"
                   value="{{ $member->role }}">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
