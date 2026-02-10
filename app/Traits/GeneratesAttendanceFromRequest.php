<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\AttendanceRequest;
use Carbon\Carbon;

trait GeneratesAttendanceFromRequest
{
    protected function generateAttendanceFromRequest(AttendanceRequest $request): void
    {
        // SAFETY: hanya jalan kalau approved
        if ($request->status !== 'approved') {
            return;
        }

        // Mapping type → attendance.status
        $statusMap = [
            'leave'  => 'leave',
            'sick'   => 'sick',
            'permit' => 'permit',
        ];

        // overtime tidak generate attendance
        if (!isset($statusMap[$request->type])) {
            return;
        }

        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {

            // Jangan override attendance yang sudah ada
            Attendance::firstOrCreate(
                [
                    'employee_id'     => $request->employee_id,
                    'attendance_date' => $date->toDateString(),
                ],
                [
                    'status' => $statusMap[$request->type],
                ]
            );
        }
    }
}