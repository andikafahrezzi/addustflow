<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HRPayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::latest()->get();
        return view('hr.payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        return view('hr.payrolls.create');
    }

public function store(Request $request)
{
    $request->validate([
        'period' => 'required|date_format:Y-m'
    ]);

    $period = $request->period;

    // ========== CEK APAKAH PAYROLL SUDAH ADA UNTUK PERIODE INI ==========
    $existingPayroll = Payroll::where('period', $period)->first();

    // Jika payroll sudah ada
    if ($existingPayroll) {
        // Ambil semua employee aktif
        $activeEmployees = Employee::where('status', 'active')->get();
        
        // Ambil employee yang SUDAH punya payroll item di payroll ini
        $existingEmployeeIds = PayrollItem::where('payroll_id', $existingPayroll->id)
            ->pluck('employee_id')
            ->toArray();
        
        // Filter employee yang BELUM punya payroll di periode ini
        $newEmployees = $activeEmployees->whereNotIn('id', $existingEmployeeIds);
        
        // Jika tidak ada employee baru
        if ($newEmployees->isEmpty()) {
            return redirect()
                ->route('hr.payrolls.show', $existingPayroll->id)
                ->with('info', "Payroll untuk periode {$period} sudah ada dan semua employee sudah tercakup.");
        }
        
        // Generate payroll items hanya untuk employee baru
        foreach ($newEmployees as $emp) {
            $salary = Salary::where('employee_id', $emp->id)
                ->where('effective_date', '<=', Carbon::parse($period)->endOfMonth())
                ->orderBy('effective_date', 'desc')
                ->first();

            if (!$salary) continue;

            PayrollItem::create([
                'payroll_id'   => $existingPayroll->id,
                'employee_id'  => $emp->id,
                'base_salary'  => $salary->base_salary,
                'allowance'    => 0,
                'overtime'     => 0,
                'bonus'        => 0,
                'deduction'    => 0,
                'total_salary' => $salary->base_salary,
            ]);
        }
        
        return redirect()
            ->route('hr.payrolls.show', $existingPayroll->id)
            ->with('success', "Berhasil menambahkan {$newEmployees->count()} employee baru ke payroll {$period}.");
    }

    // ========== JIKA PAYROLL BELUM ADA, BUAT BARU ==========
    $payroll = Payroll::create([
        'period'       => $period,
        'status'       => 'draft',
        'generated_by' => Auth::id(),
    ]);

    // Ambil semua employee aktif
    $employees = Employee::where('status', 'active')->get();

    foreach ($employees as $emp) {
        $salary = Salary::where('employee_id', $emp->id)
            ->where('effective_date', '<=', Carbon::parse($period)->endOfMonth())
            ->orderBy('effective_date', 'desc')
            ->first();

        if (!$salary) continue;

        PayrollItem::create([
            'payroll_id'   => $payroll->id,
            'employee_id'  => $emp->id,
            'base_salary'  => $salary->base_salary,
            'allowance'    => 0,
            'overtime'     => 0,
            'bonus'        => 0,
            'deduction'    => 0,
            'total_salary' => $salary->base_salary,
        ]);
    }

    return redirect()
        ->route('hr.payrolls.show', $payroll->id)
        ->with('success', 'Payroll berhasil dibuat');
}

    public function show(Payroll $payroll)
    {
        $items = $payroll->items()->with('employee.user')->get();
        return view('hr.payrolls.show', compact('payroll','items'));
    }

    public function editItem(PayrollItem $item)
    {
        return view('hr.payrolls.edit-item', compact('item'));
    }

    public function updateItem(Request $request, PayrollItem $item)
    {
        $total =
            $item->base_salary +
            $request->allowance +
            $request->overtime +
            $request->bonus -
            $request->deduction;

        $item->update([
            'allowance'    => $request->allowance,
            'overtime'     => $request->overtime,
            'bonus'        => $request->bonus,
            'deduction'    => $request->deduction,
            'total_salary' => $total,
            'notes'        => $request->notes,
        ]);

        return back()->with('success','Payroll item diperbarui');
    }
}
