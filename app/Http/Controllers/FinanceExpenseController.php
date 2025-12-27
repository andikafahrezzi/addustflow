<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FinanceExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with(['project','creator'])->latest()->get();
        return view('finance.expenses.index', compact('expenses'));
    }

    public function approve($id)
    {
        $expense = Expense::findOrFail($id);

        $expense->update([
            'status' => 'approved',
            'approved_by' => Auth::id()
        ]);

        return back()->with('success','Approved.');
    }

    public function reject($id)
    {
        $expense = Expense::findOrFail($id);

        $expense->update([
            'status' => 'rejected',
            'approved_by' => Auth::id()
        ]);

        return back()->with('success','Rejected.');
    }
}
