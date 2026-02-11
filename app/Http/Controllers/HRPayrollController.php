<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PayrollCalculatorService;
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

    $service = new PayrollCalculatorService();

    $result = $service->generateOrAppend(
        $request->period,
        Auth::id()
    );

    return redirect()
        ->route('hr.payrolls.show', $result['payroll']->id)
        ->with($result['type'], $result['message']);
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
