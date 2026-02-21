@extends('layouts.marketing')

@section('title', 'Edit Proposal')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Proposal</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi proposal</p>
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
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-4xl">
        <form action="{{ route('marketing.proposals.update', $proposal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Lead --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Lead</label>
                    <select name="lead_id" id="leadSelect"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('lead_id') border-red-400 @enderror">
                        @foreach ($leads as $lead)
                            <option value="{{ $lead->id }}" {{ $proposal->lead_id == $lead->id ? 'selected' : '' }}>
                                {{ $lead->client->name }} - ({{ $lead->title ?? 'Lead #' . $lead->id }})
                            </option>
                        @endforeach
                    </select>
                    @error('lead_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Proposal Title --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Proposal Title</label>
                    <input type="text" name="title" id="titleInput"
                           value="{{ old('title', $proposal->title) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-400 @enderror"
                           placeholder="Judul proposal">
                    @error('title')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Proposal Deskripsi</label>
                    <input type="text" name="description" id="descriptionInput"
                           value="{{ old('description', $proposal->description) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('description') border-red-400 @enderror"
                           placeholder="Deskripsi proposal">
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Estimated Value --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Estimated Value (Rp)</label>
                    <input type="number" name="estimated_value"
                           value="{{ old('estimated_value', $proposal->estimated_value) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('estimated_value') border-red-400 @enderror"
                           placeholder="0">
                    @error('estimated_value')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                    <select name="status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('status') border-red-400 @enderror">
                        @foreach (['draft','submitted'] as $status)
                            <option value="{{ $status }}" {{ $proposal->status == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-5 mt-5 border-t border-gray-100">
                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Proposal
                </button>
                <a href="{{ route('marketing.proposals.index') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>

        </form>
    </div>

<script>
    // Auto update title when lead changed
    document.getElementById('leadSelect').addEventListener('change', function () {
        let selected = this.options[this.selectedIndex].text;
        document.getElementById('titleInput').value = "Proposal for " + selected;
    });
</script>

@endsection