<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class FinanceExpenseController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('finance.expenses.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load('expenses'); // ambil expenses project ini
        return view('finance.expenses.byProject', compact('project'));
    }

    public function approve(Expense $expense)
    {
        $expense->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Expense approved.');
    }

    public function reject(Expense $expense)
    {
        $expense->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Expense rejected.');
    }

    public function approveAll(Project $project)
    {
        $project->expenses()->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'All expenses approved.');
    }

    public function rejectAll(Project $project)
    {
        $project->expenses()->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'All expenses rejected.');
    }
}