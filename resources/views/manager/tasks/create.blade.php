{{-- resources/views/manager/tasks/create.blade.php --}}
@extends('layouts.manager')

@section('title', 'Buat Task Baru')
@section('breadcrumb', 'Tasks / Buat Task Baru')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Buat Task Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Isi detail task yang akan dikerjakan</p>
        </div>
        <a href="{{ route('manager.tasks.index') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition whitespace-nowrap">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5 sm:p-8 max-w-3xl">
        <form method="POST" action="{{ route('manager.tasks.store') }}">
            @csrf

            {{-- Project --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Project <span class="text-red-500">*</span>
                </label>
                <select name="project_id" id="projectSelect"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                    <option value="">-- Pilih Project --</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                            data-repo="{{ $project->repository_url }}"
                            data-members='@json(
                                $project->members->map(function($member){
                                    return [
                                        "id" => $member->user->id,
                                        "name" => $member->user->name
                                    ];
                                })
                            )'
                            {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Repository --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Repository</label>
                <input type="text"
                    id="repoField"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-500 bg-gray-50 cursor-not-allowed"
                    readonly
                    placeholder="Repository project akan tampil di sini">
            </div>

            <hr class="border-gray-100 my-6">

            {{-- Title --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Judul Task <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                    placeholder="Contoh: Implementasi login page"
                    value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition resize-none"
                    rows="4"
                    placeholder="Jelaskan detail task ini...">{{ old('description') }}</textarea>
            </div>

            {{-- Assign To & Deadline --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Assign To <span class="text-red-500">*</span>
                    </label>
                    <select name="assigned_to" id="memberSelect"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                        <option value="">-- Pilih Member --</option>
                    </select>
                    @error('assigned_to')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Deadline <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="deadline"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                        value="{{ old('deadline') }}">
                    @error('deadline')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('manager.tasks.index') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Task
                </button>
            </div>

        </form>
    </div>

@endsection

{{-- Script tetap persis sama, hanya dipindah ke bawah --}}
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
<script>
document.addEventListener('DOMContentLoaded', function () {

    const projectSelect = document.getElementById('projectSelect');
    const memberSelect  = document.getElementById('memberSelect');
    const repoField     = document.getElementById('repoField');

    function loadProjectData() {

        const selectedOption = projectSelect.options[projectSelect.selectedIndex];

        // 🔹 Load Members
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

        // 🔹 Load Repository
        const repo = selectedOption.getAttribute('data-repo');
        repoField.value = repo ? repo : '';
    }

    projectSelect.addEventListener('change', loadProjectData);

    // Auto load kalau ada old value
    if (projectSelect.value) {
        loadProjectData();
    }

});
</script>