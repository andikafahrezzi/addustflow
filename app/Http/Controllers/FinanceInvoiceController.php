<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceInvoiceController extends Controller
{
    // Finance sees project list
    public function projectList()
    {
        $projects = Project::with('invoices')->get();

        return view('finance.invoices.projects', compact('projects'));
    }

    // Finance sees invoices inside selected project
    public function index(Project $project)
    {
        $invoices = Invoice::where('project_id', $project->id)->get();
        $expenses = $project->expenses; // list semua expenses dari project itu
        $total = $expenses->sum('amount');

        return view('finance.invoices.index', compact('project', 'invoices','expenses', 'total'));
    }

    // Approve single invoice
    public function approve(Invoice $invoice)
    {
        $invoice->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Invoice approved.');
    }

    // Reject single invoice
    public function reject(Invoice $invoice)
    {
        $invoice->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Invoice rejected.');
    }

    // Approve all invoices in selected project
    public function approveAll(Project $project)
    {
        Invoice::where('project_id', $project->id)->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'All invoices approved.');
    }

    // Reject all invoices in selected project
    public function rejectAll(Project $project)
    {
        Invoice::where('project_id', $project->id)->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'All invoices rejected.');
    }
}
