<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAttendanceRequestController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        abort_if(!$employee, 403);

        $requests = AttendanceRequest::where('employee_id', $employee->id)
            ->latest()
            ->get();

        return view('employee.attendance_requests.index', compact('requests'));
    }

    public function create()
    {
        return view('employee.attendance_requests.create');
    }

    public function store(Request $request)
    {
        $employee = Auth::user()->employee;
        abort_if(!$employee, 403);

        $request->validate([
            'type'       => 'required|in:leave,sick,permit,overtime',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'nullable|string|max:1000',
        ]);

        // ❗ cegah request overlapping
        $exists = AttendanceRequest::where('employee_id', $employee->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(
                'Sudah ada request lain pada rentang tanggal tersebut'
            );
        }

        AttendanceRequest::create([
            'employee_id' => $employee->id,
            'type'        => $request->type,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'reason'      => $request->reason,
            'status'      => 'pending',
        ]);

        return redirect()
            ->route('attendance.requests.index')
            ->with('success', 'Attendance request berhasil dikirim');
    }

    public function destroy(AttendanceRequest $attendanceRequest)
    {
        $employee = Auth::user()->employee;
        abort_if(!$employee, 403);

        if ($attendanceRequest->employee_id !== $employee->id) {
            abort(403);
        }

        if ($attendanceRequest->status !== 'pending') {
            return back()->withErrors(
                'Request sudah diproses dan tidak bisa dihapus'
            );
        }

        $attendanceRequest->delete();

        return redirect()
            ->route('attendance.requests.index')
            ->with('success', 'Request berhasil dihapus');
    }
}