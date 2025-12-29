<?php

namespace App\Http\Controllers;


use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class HRSalaryController extends Controller
{
    public function index(Employee $employee)
    {
        $salaries = Salary::where('employee_id', $employee->id)
                        ->orderBy('effective_date', 'desc')
                        ->get();

        return view('hr.salaries.index', compact('employee', 'salaries'));
    }

    public function create(Employee $employee)
    {
        return view('hr.salaries.create', compact('employee'));
    }

    public function store(Request $request, Employee $employee)
    {
        $request->validate([
            'base_salary' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
        ]);

        Salary::create([
            'employee_id' => $employee->id,
            'base_salary' => $request->base_salary,
            'effective_date' => $request->effective_date,
        ]);

        return redirect()
            ->route('hr.salaries.index', $employee->id)
            ->with('success', 'Salary berhasil ditambahkan.');
    }

    public function edit(Salary $salary)
    {
        return view('hr.salaries.edit', compact('salary'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'base_salary' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
        ]);

        $salary->update([
            'base_salary' => $request->base_salary,
            'effective_date' => $request->effective_date,
        ]);

        return redirect()
            ->route('hr.salaries.index', $salary->employee_id)
            ->with('success', 'Salary berhasil diperbarui.');
    }

    public function destroy(Salary $salary)
    {
        $employeeId = $salary->employee_id;

        $salary->delete();

        return redirect()
            ->route('hr.salaries.index', $employeeId)
            ->with('success', 'Salary berhasil dihapus.');
    }
}
