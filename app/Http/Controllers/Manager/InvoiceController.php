<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\Expense;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // List all invoices under project
    public function index(Project $project)
    {
        $invoices = Invoice::where('project_id', $project->id)->latest()->get();

        return view('manager.invoices.index', compact('project', 'invoices'));
    }

    // Form create invoice (summary expenses)
    public function create(Project $project)
    {
        $expenses = Expense::where('project_id', $project->id)->get();
        $total = $expenses->sum('amount');

        return view('manager.invoices.create', compact('project', 'expenses', 'total'));
    }

    // Save new invoice
    public function store(Project $project)
    {
        $expenses = Expense::where('project_id', $project->id)->get();
        $total = $expenses->sum('amount');

        $invoice = Invoice::create([
            'project_id' => $project->id,
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
            'amount' => $total,
        ]);

        return redirect()->route('manager.invoices.index', $project->id)
            ->with('success', 'Invoice created successfully.');
    }
}
