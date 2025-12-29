<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class HREmployeeController extends Controller
{
    // List Karyawan
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('hr.employees.index', compact('employees'));
    }

    // Form Tambah
    public function create()
    {
        $users = User::doesntHave('employee')->get(); // user yg belum jadi karyawan
        return view('hr.employees.create', compact('users'));
    }

    // Simpan
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|string',
            'join_date' => 'required|date',
        ]);

        Employee::create($request->only('user_id','position','join_date'));

        return redirect()->route('hr.employees.index')
            ->with('success','Karyawan berhasil ditambahkan.');
    }

    // Form Edit
    public function edit(Employee $employee)
    {
        return view('hr.employees.edit', compact('employee'));
    }

    // Update
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'position' => 'required|string',
            'join_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $employee->update($request->only('position','join_date','status'));

        return redirect()->route('hr.employees.index')
            ->with('success','Data karyawan berhasil diperbarui.');
    }

    // Nonaktifkan
    public function deactivate(Employee $employee)
    {
        $employee->update([
            'status' => 'inactive'
        ]);

        return back()->with('success','Karyawan dinonaktifkan.');
    }

    // Hapus karyawan
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('success','Karyawan berhasil dihapus.');
    }
}
