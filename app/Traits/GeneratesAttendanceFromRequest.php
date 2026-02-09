<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\AttendanceRequest;
use Carbon\Carbon;

trait GeneratesAttendanceFromRequest
{
    protected function generateAttendanceFromRequest(AttendanceRequest $request): void
    {
        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        for ($date = $start; $date->lte($end); $date->addDay()) {

            Attendance::firstOrCreate(
                [
                    'employee_id'     => $request->employee_id,
                    'attendance_date' => $date->toDateString(),
                ],
                [
                    // status HARUS match enum attendances
                    'status' => $request->type, // leave / sick / permit
                ]
            );
        }
    }
}