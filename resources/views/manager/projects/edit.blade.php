{{-- resources/views/manager/projects/edit.blade.php --}}
@extends('layouts.manager')

@section('title', 'Edit Project')
@section('breadcrumb', 'Projects / Edit Project')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Project</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui detail project</p>
        </div>
        <a href="{{ route('manager.projects.index') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition whitespace-nowrap">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5 sm:p-8 max-w-2xl">
        <form action="{{ route('manager.projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Pilih Proposal --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Pilih Proposal <span class="text-red-500">*</span>
                </label>
                <select id="proposal-edit" name="proposal_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white"
                    required>
                    @foreach($proposals as $item)
                        <option
                            value="{{ $item->id }}"
                            data-estimated="{{ $item->estimated_value }}"
                            data-repo="{{ $item->project->repository_url ?? '' }}"
                            {{ $item->id == $project->proposal_id ? 'selected' : '' }}>
                            {{ $item->title }}
                        </option>
                    @endforeach
                </select>
                @error('proposal_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Repository URL --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Repository URL</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                    <input type="url" name="repository_url" id="repo-field"
                        class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                        value="{{ old('repository_url', $project->repository_url) }}"
                        placeholder="https://github.com/username/repo">
                </div>
                @error('repository_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Estimated Value (readonly) --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Estimated Value</label>
                <input type="number" id="estimated-edit"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-500 bg-gray-50 cursor-not-allowed"
                    value="{{ $project->proposal->estimated_value }}"
                    readonly>
            </div>

            {{-- Budget Project --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Budget Project <span class="text-red-500">*</span>
                </label>
                <input type="number" name="budget"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                    value="{{ $project->budget }}"
                    required>
                @error('budget')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Start Date & End Date --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Start Date</label>
                    <input type="date" name="start_date"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                        value="{{ $project->start_date }}">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">End Date</label>
                    <input type="date" name="end_date"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                        value="{{ $project->end_date }}">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('manager.projects.index') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update
                </button>
            </div>

        </form>
    </div>

@endsection

<script>
window.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('proposal-edit');

    function loadProposalData() {
        const selected = select.selectedOptions[0];
        document.getElementById('estimated-edit').value = selected.dataset.estimated || "";
        document.getElementById('repo-field').value = selected.dataset.repo || "";
    }

    // Auto load saat halaman dibuka
    loadProposalData();

    // Update saat dropdown diganti
    select.addEventListener('change', loadProposalData);
});
</script>