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
        
        $user = \App\Models\User::with('role')
                ->find(Auth::id());

        $layout = match ($user->role->name) {
            'hr' => 'layouts.hr',
            'manager' => 'layouts.manager',
            'staff' => 'layouts.staff',
            'admin' => 'layouts.admin',
            'finance' => 'layouts.finance',
            'marketing' => 'layouts.marketing',
            default => 'layouts.staff',
        };
        abort_if(!$employee, 403, 'Employee data not found');

        $today = now()->toDateString();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $today)
            ->first();

        return view('employee.index', compact('attendance', 'layout'));
    }

    /**
     * CHECK IN
     */
public function checkIn(Request $request)
{
    $employee = Auth::user()->employee;
    abort_if(!$employee, 403, 'Employee not found');

    $request->validate([
        'lat'   => 'required|numeric',
        'lng'   => 'required|numeric',
        'photo' => 'required|string',
    ]);

    $today = now()->toDateString();

    // 1 employee hanya boleh 1 attendance per hari
    $attendance = Attendance::firstOrCreate([
        'employee_id'     => $employee->id,
        'attendance_date' => $today,
    ]);

    if ($attendance->check_in_at) {
        return back()->withErrors('Sudah check-in hari ini');
    }

    // simpan foto
    $image = $request->photo;

    $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);
    $image = str_replace(' ', '+', $image);

    $imageName = 'checkin_' . time() . '.jpg';

    Storage::disk('public')->put(
        'attendance/check-in/' . $imageName,
        base64_decode($image)
    );

    $photoPath = 'attendance/check-in/' . $imageName;

    // hitung keterlambatan
    $checkInTime  = now();
    $officeStart  = Carbon::createFromTime(8, 0, 0);

    $lateMinutes = max(
        0,
        $officeStart->diffInMinutes($checkInTime, false)
    );

    $status = $lateMinutes > 0 ? 'late' : 'present';

    // simpan data
    $attendance->update([
        'check_in_at'    => $checkInTime->format('H:i:s'),
        'late_minutes'   => $lateMinutes,
        'status'         => $status,
        'check_in_lat'   => $request->lat,
        'check_in_lng'   => $request->lng,
        'check_in_photo' => $photoPath,
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
            'photo' => 'required|string',
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

        $image = $request->photo;

        $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = 'checkout_' . time() . '.jpg';

        Storage::disk('public')->put(
            'attendance/check-out/' . $imageName,
            base64_decode($image)
        );

        $photoPath = 'attendance/check-out/' . $imageName;

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