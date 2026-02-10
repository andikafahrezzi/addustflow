@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Attendance Monitoring (HR)</h1>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Employee</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Check In</th>
                    <th class="px-4 py-3">Check Out</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Corrected</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($attendances as $attendance)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">
                            {{ $attendance->employee->user->name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $attendance->attendance_date->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $attendance->check_in_at ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $attendance->check_out_at ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs
                                @if($attendance->status === 'present') bg-green-100 text-green-700
                                @elseif($attendance->status === 'late') bg-yellow-100 text-yellow-700
                                @elseif(in_array($attendance->status, ['leave','sick','permit'])) bg-blue-100 text-blue-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            @if($attendance->is_corrected)
                                <span class="text-green-600 font-medium">Yes</span>
                            @else
                                <span class="text-gray-400">No</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center" x-data="{ open: false }">
    <button
        @click="open = true"
        class="px-3 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700"
    >
        Correct
    </button>

    <!-- MODAL -->
    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[9999] flex items-center justify-center"
    >
        <!-- Overlay -->
        <div
            class="absolute inset-0 bg-black/60"
            @click="open = false"
        ></div>

        <!-- Modal box -->
        <div
            class="relative bg-white w-full max-w-md rounded-lg shadow-lg p-6"
        >
            <h2 class="text-lg font-semibold mb-4 text-gray-800">
                Correct Attendance
            </h2>

            <form method="POST"
                  action="{{ route('hr.attendances.correct', $attendance) }}">
                @csrf
                @method('PATCH')

                <!-- STATUS -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status
                    </label>
                    <select
                        name="status"
                        class="w-full rounded border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    >
                        @foreach(['present','late','absent','leave','sick','permit'] as $status)
                            <option value="{{ $status }}"
                                @selected($attendance->status === $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- REASON -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Correction Reason
                    </label>
                    <textarea
                        name="correction_reason"
                        rows="3"
                        required
                        class="w-full rounded border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Explain why this attendance is corrected..."
                    >{{ old('correction_reason', $attendance->correction_reason) }}</textarea>
                </div>

                <!-- ACTIONS -->
                <div class="flex justify-end gap-2 pt-2">
                    <button
                        type="button"
                        @click="open = false"
                        class="px-4 py-2 text-sm rounded border border-gray-300 text-gray-700 hover:bg-gray-100"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 text-sm rounded bg-indigo-600 text-white hover:bg-indigo-700"
                    >
                        Save Correction
                    </button>
                </div>
            </form>
        </div>
    </div>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7"
                            class="text-center py-6 text-gray-500">
                            No attendance records found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection