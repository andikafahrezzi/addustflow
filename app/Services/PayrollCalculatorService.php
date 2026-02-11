<?php

namespace App\Services;

use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use Carbon\Carbon;

class PayrollCalculatorService
{
    public function generateOrAppend(string $period, int $userId): array
    {
        $existingPayroll = Payroll::where('period', $period)->first();

        if ($existingPayroll) {
            return $this->appendEmployees($existingPayroll, $period);
        }

        return $this->createPayroll($period, $userId);
    }

    protected function createPayroll(string $period, int $userId): array
    {
        $payroll = Payroll::create([
            'period'       => $period,
            'status'       => 'draft',
            'generated_by' => $userId,
        ]);

        $this->generateItems($payroll, $period);

        return [
            'payroll' => $payroll,
            'type' => 'success',
            'message' => "Payroll periode {$period} berhasil dibuat."
        ];
    }

    protected function appendEmployees(Payroll $payroll, string $period): array
    {
        $activeEmployees = Employee::where('status', 'active')->get();

        $existingEmployeeIds = PayrollItem::where('payroll_id', $payroll->id)
            ->pluck('employee_id')
            ->toArray();

        $newEmployees = $activeEmployees->whereNotIn('id', $existingEmployeeIds);

        if ($newEmployees->isEmpty()) {
            return [
                'payroll' => $payroll,
                'type' => 'info',
                'message' => "Payroll sudah ada dan semua employee tercakup."
            ];
        }

        $this->generateItems($payroll, $period, $newEmployees);

        return [
            'payroll' => $payroll,
            'type' => 'success',
            'message' => "Berhasil menambahkan {$newEmployees->count()} employee baru."
        ];
    }

    protected function generateItems(Payroll $payroll, string $period, $employees = null)
    {
        $employees = $employees ?? Employee::where('status', 'active')->get();

        foreach ($employees as $emp) {

            $salary = Salary::where('employee_id', $emp->id)
                ->where('effective_date', '<=', Carbon::parse($period)->endOfMonth())
                ->orderBy('effective_date', 'desc')
                ->first();

            if (!$salary) continue;

            $attendance = $this->calculateAttendance($emp, $period);

            $deduction = $this->calculateDeduction($salary, $attendance);

            $total = $salary->base_salary - $deduction;

            PayrollItem::create([
                'payroll_id'   => $payroll->id,
                'employee_id'  => $emp->id,
                'base_salary'  => $salary->base_salary,
                'allowance'    => 0,
                'overtime'     => 0,
                'bonus'        => 0,
                'deduction'    => $deduction,
                'total_salary' => $total,
            ]);
        }
    }

    protected function calculateAttendance(Employee $employee, string $period): array
    {
        $start = Carbon::parse($period)->startOfMonth();
        $end   = Carbon::parse($period)->endOfMonth();

        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereBetween('attendance_date', [$start, $end])
            ->get();

        return [
            'absent_days' => $attendances->where('status', 'absent')->count(),
            'late_minutes' => $attendances->sum('late_minutes'),
        ];
    }

    protected function calculateDeduction($salary, array $attendance): float
    {
        $baseSalary = $salary->base_salary;

        $dailyRate  = $baseSalary / 22;
        $hourlyRate = $baseSalary / 173;

        $absentDeduction = $attendance['absent_days'] * $dailyRate;

        $lateHours = $attendance['late_minutes'] / 60;
        $lateDeduction = $lateHours * $hourlyRate;

        return $absentDeduction + $lateDeduction;
    }
}