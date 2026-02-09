<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class ManagerAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('employee.user');

        if ($request->filled('date')) {
            $query->where('attendance_date', $request->date);
        }

        $attendances = $query
            ->orderBy('attendance_date', 'desc')
            ->get();

        return view('manager.attendances.index', compact('attendances'));
    }
}