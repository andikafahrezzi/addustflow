<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'check_in_at',
        'check_out_at',
        'late_minutes',
        'status',
        'check_in_lat',
        'check_in_lng',
        'check_out_lat',
        'check_out_lng',
        'check_in_photo',
        'check_out_photo',
        'is_corrected',
        'correction_reason',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'check_in_at' => 'string',   // TIME, bukan datetime
        'check_out_at' => 'string',
        'late_minutes' => 'integer',
        'is_corrected' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}