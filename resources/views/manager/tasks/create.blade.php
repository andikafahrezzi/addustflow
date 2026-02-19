@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Buat Task Baru</h1>

    <div class="bg-white shadow rounded-xl p-6">

        <form method="POST" action="{{ route('manager.tasks.store') }}">
            @csrf

            {{-- Project --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Project</label>
                <select name="project_id" id="projectSelect"
                    class="w-full border rounded-lg p-2">
                    <option value="">-- Pilih Project --</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                            data-members='@json(
                                $project->members->map(function($member){
                                    return [
                                        "id" => $member->user->id,
                                        "name" => $member->user->name
                                    ];
                                })
                            )'
                            {{ old('project_id') == $project->id ? 'selected' : '' }}
                        >
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>

                @error('project_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Title --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Judul Task</label>
                <input type="text" name="title"
                    class="w-full border rounded-lg p-2"
                    value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Deskripsi</label>
                <textarea name="description"
                    class="w-full border rounded-lg p-2"
                    rows="4">{{ old('description') }}</textarea>
            </div>

            {{-- Assigned To --}}
            <div class="mb-6">
                <label class="block font-semibold mb-2">Assign To</label>
                <select name="assigned_to" id="memberSelect"
                    class="w-full border rounded-lg p-2">
                    <option value="">-- Pilih Member --</option>
                </select>

                @error('assigned_to')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Deadline --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Deadline</label>
                <input type="date" name="deadline"
                    class="w-full border rounded-lg p-2"
                    value="{{ old('deadline') }}">
                @error('deadline')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Simpan Task
            </button>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const projectSelect = document.getElementById('projectSelect');
    const memberSelect  = document.getElementById('memberSelect');

    function loadMembers() {
        const selectedOption = projectSelect.options[projectSelect.selectedIndex];
        const membersData = selectedOption.getAttribute('data-members');

        memberSelect.innerHTML = '<option value="">-- Pilih Member --</option>';

        if (membersData) {
            const members = JSON.parse(membersData);

            members.forEach(member => {
                const option = document.createElement('option');
                option.value = member.id;
                option.textContent = member.name;

                if ("{{ old('assigned_to') }}" == member.id) {
                    option.selected = true;
                }

                memberSelect.appendChild(option);
            });
        }
    }

    projectSelect.addEventListener('change', loadMembers);

    // Auto load kalau ada old value
    if (projectSelect.value) {
        loadMembers();
    }

});
</script>

@endsection