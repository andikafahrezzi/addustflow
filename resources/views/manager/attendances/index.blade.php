@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h1 class="text-xl font-semibold mb-4">Attendance Monitoring</h1>

    {{-- Filter tanggal --}}
    <form method="GET" class="mb-4 flex gap-3">
        <input type="date"
               name="date"
               value="{{ request('date') }}"
               class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>
    </form>

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Tanggal</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Check In</th>
                <th class="px-4 py-2 border">Check Out</th>
                <th class="px-4 py-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
        @forelse($attendances as $att)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $att->attendance_date }}</td>
                <td class="px-4 py-2">
                    {{ $att->employee->user->name }}
                </td>
                <td class="px-4 py-2">
                    {{ $att->check_in_at ?? '-' }}
                </td>
                <td class="px-4 py-2">
                    {{ $att->check_out_at ?? '-' }}
                </td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded text-xs
                        {{ $att->status === 'late' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                        {{ ucfirst($att->status) }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">
                    Tidak ada data
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection