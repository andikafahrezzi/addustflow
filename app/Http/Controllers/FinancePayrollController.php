<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('generator')
            ->latest()
            ->get();

        return view('finance.payrolls.index', compact('payrolls'));
    }

    public function show(Payroll $payroll)
    {
        $items = $payroll->items()
            ->with('employee.user')
            ->get();

        $total = $items->sum('total_salary');

        return view('finance.payrolls.show', compact(
            'payroll','items','total'
        ));
    }

    public function approve(Payroll $payroll)
    {
        if ($payroll->status !== 'draft') {
            return back()->with('error','Payroll sudah diproses.');
        }

        $payroll->update([
            'status'      => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success','Payroll approved.');
    }

    public function paid(Payroll $payroll)
    {
        if ($payroll->status !== 'approved') {
            return back()->with('error','Payroll harus approved dulu.');
        }

        $payroll->update([
            'status' => 'paid',
        ]);

        return back()->with('success','Payroll ditandai paid.');
    }
}
