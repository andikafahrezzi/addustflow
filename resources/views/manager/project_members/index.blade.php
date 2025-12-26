{{-- EXTEND layout utama --}}
@extends('layouts.app')


{{-- SET content utama --}}
@section('content')
<div class="container">
    <h3>Project Members – {{ $project->name }}</h3>

    <a href="{{ route('manager.projects.members.create',$project->id) }}" 
       class="btn btn-primary mb-3">
        Tambah Member
    </a>
    <a href="{{ route('manager.projects.members.create',$project->id) }}" 
       class="btn btn-primary mb-3">
        Tambah Member
    </a>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Role</th>
                <th width="150px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $m)
            <tr>
                <td class=" text-red-500">{{ $m->user->name }}</td>
                <td>{{ $m->role ?? '-' }}</td>
                <td>
                    <a href="{{ route('manager.projects.members.edit',[$project->id, $m->id]) }}"
                       class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('manager.projects.members.destroy',[$project->id,$m->id]) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus member?')" 
                                class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
