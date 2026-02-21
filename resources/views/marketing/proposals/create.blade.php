@extends('layouts.marketing')

@section('title', 'Buat Proposal Baru')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Buat Proposal Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Isi form berikut untuk membuat proposal baru</p>
        </div>
        <a href="{{ route('marketing.proposals.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
        <form action="{{ route('marketing.proposals.store') }}" method="POST">
            @csrf

            {{-- Lead --}}
            <div class="mb-5">
                <label for="lead_id" class="block text-sm font-medium text-gray-700 mb-1.5">Lead</label>
                <select name="lead_id" id="lead_id"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('lead_id') border-red-400 @enderror"
                        required>
                    <option value="">-- Pilih Lead --</option>
                    @foreach($leads as $lead)
                        <option
                            value="{{ $lead->id }}"
                            data-title="{{ $lead->title ?? 'Lead #' . $lead->id . ' - ' . $lead->client->name }}">
                            {{ $lead->client->name }} - ({{ $lead->title ?? 'Lead #' . $lead->id }})
                        </option>
                    @endforeach
                </select>
                @error('lead_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Judul Proposal --}}
            <div class="mb-5">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1.5">Judul Proposal</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-400 @enderror"
                       placeholder="Judul proposal" required>
                @error('title')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-5">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none @error('description') border-red-400 @enderror"
                          placeholder="Deskripsi proposal">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Estimasi Nilai --}}
            <div class="mb-5">
                <label for="estimated_value" class="block text-sm font-medium text-gray-700 mb-1.5">Estimasi Nilai (Rp)</label>
                <input type="number" name="estimated_value" id="estimated_value"
                       value="{{ old('estimated_value') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('estimated_value') border-red-400 @enderror"
                       placeholder="0" required>
                @error('estimated_value')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                <select name="status" id="status"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('status') border-red-400 @enderror"
                        required>
                    <option value="draft">Draft</option>
                    <option value="submitted">Submitted</option>
                </select>
                @error('status')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Proposal
                </button>
                <a href="{{ route('marketing.proposals.index') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>

        </form>
    </div>

<script>
document.getElementById('lead_id').addEventListener('change', function() {
    let selected = this.options[this.selectedIndex];
    if (selected) {
        let title = selected.getAttribute('data-title');
        document.getElementById('title').value = title || '';
    }
});
</script>

@endsection