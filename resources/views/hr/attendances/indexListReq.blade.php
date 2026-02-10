@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Attendance Requests</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Employee</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Date Range</th>
                    <th class="px-4 py-3">Reason</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($requests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{ $request->employee->user->name }}
                        </td>
                        <td class="px-4 py-3 capitalize">
                            {{ $request->type }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $request->start_date->format('d M Y') }}
                            →
                            {{ $request->end_date->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $request->reason ?? '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs
                                @if($request->status === 'pending') bg-yellow-100 text-yellow-700
                                @elseif($request->status === 'approved') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($request->status === 'pending')
                                <div class="flex justify-center gap-2">
                                    <form method="POST"
                                          action="{{ route('hr.attendance-requests.approve', $request->id) }}">
                                        @csrf
                                        <button class="px-3 py-1 bg-green-600 text-white rounded text-xs hover:bg-green-700">
                                            Approve
                                        </button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('hr.attendance-requests.reject', $request->id) }}">
                                        @csrf
                                        <button class="px-3 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-400 text-xs">
                                    Finalized
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">
                            No attendance requests found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection