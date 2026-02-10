@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold">Attendance Requests</h1>

        <a href="{{ route('attendance.requests.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + New Request
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3">Start</th>
                    <th class="px-4 py-3">End</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-left">Reason</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($requests as $req)
                    <tr class="border-t">
                        <td class="px-4 py-3 capitalize">{{ $req->type }}</td>
                        <td class="px-4 py-3">{{ $req->start_date }}</td>
                        <td class="px-4 py-3">{{ $req->end_date }}</td>
                        <td class="px-4 py-3">
                            @if ($req->status === 'pending')
                                <span class="text-yellow-600 font-medium">Pending</span>
                            @elseif ($req->status === 'approved')
                                <span class="text-green-600 font-medium">Approved</span>
                            @else
                                <span class="text-red-600 font-medium">Rejected</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            {{ $req->reason ?? '-' }}
                        </td>
                        <td class="px-4 py-3">
                            @if ($req->status === 'pending')
                                <form action="{{ route('attendance.requests.destroy', $req) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin mau hapus request ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-red-600 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Belum ada request
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection