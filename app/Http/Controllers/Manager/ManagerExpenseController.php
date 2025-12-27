<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerExpenseController extends Controller
{
   public function index(Project $project)
    {
        $expenses = Expense::where('project_id', $project->id)->get();

        return view('manager.expenses.index', compact('project', 'expenses'));
    }

    public function create(Project $project)
    {
        return view('manager.expenses.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        Expense::create([
            'project_id' => $project->id,
            'description' => $request->description,
            'amount' => $request->amount,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('manager.projects.expenses.index', $project->id)
            ->with('success', 'Expense created successfully.');
    }

    public function edit(Project $project, Expense $expense)
    {
        return view('manager.expenses.edit', compact('project', 'expense'));
    }

    public function update(Request $request, Project $project, Expense $expense)
    {
        $request->validate([
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'status'          => 'pending',
        ]);

        $expense->update([
            'description' => $request->description,
            'amount' => $request->amount,
            'status'      => 'pending',
        ]);

        return redirect()->route('manager.projects.expenses.index', $project->id)
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Project $project, Expense $expense)
    {
        $expense->delete();

        return redirect()->route('manager.projects.expenses.index', $project->id)
            ->with('success', 'Expense deleted successfully.');
    }
}
