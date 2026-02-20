{{-- resources/views/manager/proposals/index.blade.php --}}
@extends('layouts.manager')

@section('title', 'Daftar Proposal')
@section('breadcrumb', 'Proposals')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Proposal</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola dan review semua proposal masuk</p>
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-6">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- =============================== --}}
    {{-- SECTION 1: Menunggu Approval --}}
    {{-- =============================== --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <h2 class="text-base font-semibold text-gray-800">Menunggu Approval</h2>
            <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">
                {{ $proposals->where('status', 'submitted')->count() }}
            </span>
        </div>

        @if($proposals->where('status', 'submitted')->count() == 0)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-8 text-center text-gray-400">
                <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm">Tidak ada proposal yang sedang menunggu approval.</p>
            </div>
        @else

            {{-- Desktop Table --}}
            <div class="hidden md:block bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Estimasi Nilai</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($proposals->where('status', 'submitted') as $proposal)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $proposal->title }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $proposal->lead->client->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">Rp {{ number_format($proposal->estimated_value, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex items-center gap-2">
                                            <form action="{{ route('manager.proposals.approve', $proposal->id) }}" method="POST">
                                                @csrf
                                                <button class="inline-flex items-center px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-700 text-xs font-medium rounded-lg transition">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('manager.proposals.reject', $proposal->id) }}" method="POST">
                                                @csrf
                                                <button class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-medium rounded-lg transition">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile Card View --}}
            <div class="md:hidden space-y-3">
                @foreach($proposals->where('status', 'submitted') as $proposal)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                        <div class="mb-3">
                            <p class="text-sm font-semibold text-gray-800">{{ $proposal->title }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $proposal->lead->client->name }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg px-3 py-2 mb-3">
                            <p class="text-xs text-gray-400">Estimasi Nilai</p>
                            <p class="text-sm font-semibold text-gray-700">Rp {{ number_format($proposal->estimated_value, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex gap-2 pt-3 border-t border-gray-100">
                            <form action="{{ route('manager.proposals.approve', $proposal->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button class="w-full inline-flex items-center justify-center px-3 py-2 bg-green-50 hover:bg-green-100 text-green-700 text-xs font-medium rounded-lg transition">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('manager.proposals.reject', $proposal->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-medium rounded-lg transition">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>

    {{-- =============================== --}}
    {{-- SECTION 2: Sudah Diproses      --}}
    {{-- =============================== --}}
    <div>
        <div class="flex items-center gap-2 mb-4">
            <h2 class="text-base font-semibold text-gray-800">Sudah Diproses</h2>
            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">
                {{ $proposals->whereIn('status', ['approved', 'rejected'])->count() }}
            </span>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($proposals->whereIn('status', ['approved', 'rejected']) as $proposal)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $proposal->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $proposal->lead->client->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if($proposal->status == 'approved')
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Approved</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Rejected</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $proposal->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Card View --}}
        <div class="md:hidden space-y-3">
            @foreach($proposals->whereIn('status', ['approved', 'rejected']) as $proposal)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ $proposal->title }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $proposal->lead->client->name }}</p>
                        </div>
                        @if($proposal->status == 'approved')
                            <span class="flex-shrink-0 px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Approved</span>
                        @else
                            <span class="flex-shrink-0 px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Rejected</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-400 mt-2">{{ $proposal->created_at->format('d/m/Y') }}</p>
                </div>
            @endforeach
        </div>
    </div>

@endsection