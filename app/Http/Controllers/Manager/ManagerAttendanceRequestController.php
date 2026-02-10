<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\AttendanceRequest;
use App\Traits\GeneratesAttendanceFromRequest;
use Illuminate\Support\Facades\Auth;

class ManagerAttendanceRequestController extends Controller
{
    use GeneratesAttendanceFromRequest;

    public function index()
    {
        $requests = AttendanceRequest::with('employee.user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manager.attendances.indexListReq', compact('requests'));
    }

    public function approve($id)
    {
        $request = AttendanceRequest::where('status', 'pending')->findOrFail($id);

        $request->update([
            'status'      => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        // ⬅️ SAME LOGIC, SAME TRAIT
        $this->generateAttendanceFromRequest($request);

        return back()->with('success', 'Attendance request approved');
    }

    public function reject($id)
    {
        $request = AttendanceRequest::where('status', 'pending')->findOrFail($id);

        $request->update([
            'status'      => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Attendance request rejected');
    }
}