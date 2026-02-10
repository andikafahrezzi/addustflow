<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EmployeeAttendanceController extends Controller
{
    /**
     * Tampilkan status attendance hari ini
     */
    public function index()
    {
        $employee = Auth::user()->employee;
        abort_if(!$employee, 403, 'Employee data not found');

        $today = now()->toDateString();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $today)
            ->first();

        return view('employee.index', compact('attendance'));
    }

    /**
     * CHECK IN
     */
    public function checkIn(Request $request)
    {
        $employee = Auth::user()->employee;
        abort_if(!$employee, 403);

        $request->validate([
            'lat'   => 'required|numeric',
            'lng'   => 'required|numeric',
            'photo' => 'required|image|max:2048', // max 2MB
        ]);

        $today = now()->toDateString();

        // pastikan belum ada record hari ini
        $attendance = Attendance::firstOrCreate(
            [
                'employee_id'    => $employee->id,
                'attendance_date'=> $today,
            ]
        );

        if ($attendance->exists && $attendance->check_in_at !== null) {
            return back()->withErrors('Sudah check-in hari ini');
        }

        // simpan foto
        $photoPath = $request->file('photo')
            ->store('attendance/check-in', 'public');
        $checkInTime = Carbon::now();
        $officeStart = Carbon::createFromTime(8, 0, 0);

        $lateMinutes = 0;
        $status = 'present';

        if ($checkInTime->gt($officeStart)) {
            $lateMinutes = $officeStart->diffInMinutes($checkInTime);
            $status = 'late';
        }
        $attendance->update([
            'check_in_at'   => Carbon::now()->format('H:i:s'),
            'check_in_lat'  => $request->lat,
            'check_in_lng'  => $request->lng,
            'check_in_photo'=> $photoPath,
            'status'        => $status,
        ]);

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Check-in berhasil');
    }

    /**
     * CHECK OUT
     */
    public function checkOut(Request $request)
    {
        $employee = Auth::user()->employee;
        abort_if(!$employee, 403);

        $request->validate([
            'lat'   => 'required|numeric',
            'lng'   => 'required|numeric',
            'photo' => 'required|image|max:2048',
        ]);

        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $today)
            ->first();

        if (!$attendance || !$attendance->check_in_at) {
            return back()->withErrors('Belum check-in');
        }

        if ($attendance->check_out_at) {
            return back()->withErrors('Sudah check-out');
        }

        $photoPath = $request->file('photo')
            ->store('attendance/check-out', 'public');

        $attendance->update([
            'check_out_at'   => Carbon::now()->format('H:i:s'),
            'check_out_lat'  => $request->lat,
            'check_out_lng'  => $request->lng,
            'check_out_photo'=> $photoPath,
        ]);

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Check-out berhasil');
    }
}