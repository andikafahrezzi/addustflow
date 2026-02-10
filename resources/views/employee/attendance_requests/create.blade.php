@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">

    <h1 class="text-xl font-semibold mb-6">
        New Attendance Request
    </h1>

    <form action="{{ route('attendance.requests.store') }}"
          method="POST"
          class="bg-white rounded shadow p-6 space-y-4">

        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Type</label>
            <select name="type" class="w-full border rounded px-3 py-2">
                <option value="">-- Select Type --</option>
                <option value="leave">Leave (Cuti)</option>
                <option value="sick">Sick (Sakit)</option>
                <option value="permit">Permit (Izin)</option>
                <option value="overtime">Overtime (Lembur)</option>
            </select>
            @error('type')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Start Date</label>
                <input type="date" name="start_date"
                       class="w-full border rounded px-3 py-2">
                @error('start_date')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">End Date</label>
                <input type="date" name="end_date"
                       class="w-full border rounded px-3 py-2">
                @error('end_date')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Reason (optional)
            </label>
            <textarea name="reason"
                      rows="3"
                      class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('attendance.requests.index') }}"
               class="px-4 py-2 border rounded">
                Cancel
            </a>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Submit
            </button>
        </div>
    </form>

</div>
@endsection