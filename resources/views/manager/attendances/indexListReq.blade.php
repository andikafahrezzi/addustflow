@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h1 class="text-xl font-semibold mb-4">Attendance Requests</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Tipe</th>
                <th class="px-4 py-2 border">Tanggal</th>
                <th class="px-4 py-2 border">Alasan</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($requests as $req)
            <tr class="border-t">
                <td class="px-4 py-2">
                    {{ $req->employee->user->name }}
                </td>
                <td class="px-4 py-2 capitalize">
                    {{ $req->type }}
                </td>
                <td class="px-4 py-2">
                    {{ $req->start_date }} → {{ $req->end_date }}
                </td>
                <td class="px-4 py-2">
                    {{ $req->reason ?? '-' }}
                </td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded text-xs
                        @if($req->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($req->status === 'approved') bg-green-100 text-green-600
                        @else bg-red-100 text-red-600
                        @endif">
                        {{ ucfirst($req->status) }}
                    </span>
                </td>
                <td class="px-4 py-2">
                    @if($req->status === 'pending')
                        <div class="flex gap-2">
                            <form method="POST"
                                  action="{{ route('manager.attendance-requests.approve', $req->id) }}">
                                @csrf
                                <button class="bg-green-600 text-white px-3 py-1 rounded text-xs">
                                    Approve
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('manager.attendance-requests.reject', $req->id) }}">
                                @csrf
                                <button class="bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    Reject
                                </button>
                            </form>
                        </div>
                    @else
                        <span class="text-gray-400 text-xs">—</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">
                    Tidak ada request
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection