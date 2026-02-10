<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\AttendanceRequest;
use Carbon\Carbon;

trait GeneratesAttendanceFromRequest
{
    protected function generateAttendanceFromRequest(AttendanceRequest $request): void
    {
        // hanya jalan kalau approved
        if ($request->status !== 'approved') {
            return;
        }

        $statusMap = [
            'leave'  => 'leave',
            'sick'   => 'sick',
            'permit' => 'permit',
        ];

        // overtime tidak mempengaruhi attendance
        if (!isset($statusMap[$request->type])) {
            return;
        }

        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {

            $attendance = Attendance::firstOrCreate(
                [
                    'employee_id'     => $request->employee_id,
                    'attendance_date' => $date->toDateString(),
                ],
                [
                    'status' => $statusMap[$request->type],
                ]
            );

            // 🔥 INI KUNCI HR OVERRIDE
            if ($attendance->exists) {
                $attendance->update([
                    'status'            => $statusMap[$request->type],
                    'is_corrected'      => true,
                    'correction_reason' => ucfirst($request->type) . ' approved by HR',
                ]);
            }
        }
    }
}