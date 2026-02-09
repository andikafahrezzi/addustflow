<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class HRAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('employee.user');

        // optional filter (tidak wajib dipakai sekarang)
        if ($request->filled('date')) {
            $query->where('attendance_date', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query
            ->orderBy('attendance_date', 'desc')
            ->get();

        return view('hr.attendances.index', compact('attendances'));
    }
}