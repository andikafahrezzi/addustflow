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
    public function indexInvoices(Project $project)
    {
       $projects = Project::orderBy('created_at', 'desc')->get();
        return view('finance.invoices.indexInvoices', compact('projects'));
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
    public function show(Invoice $invoice)
    {
        $project = $invoice->project;
        $expenses = $project->expenses()
            ->orderBy('created_at','asc')
            ->get();

        return view('finance.invoices.showClient', compact('invoice','project','expenses'));
    }

    /** Send invoice ke client */
    public function send(Invoice $invoice)
    {
        if ($invoice->status !== 'approved') {
            return back()->with('error','Invoice harus di-approve dulu.');
        }

        $invoice->update([
            'status' => 'sent',
        ]);

        return back()->with('success','Invoice berhasil dikirim ke client.');
    }

    /** Mark as Paid */
    public function paid(Invoice $invoice)
    {
        if ($invoice->status !== 'sent') {
            return back()->with('error','Invoice harus dikirim sebelum ditandai dibayar.');
        }

        $invoice->update([
            'status' => 'paid',
        ]);

        return back()->with('success','Invoice berhasil ditandai sebagai dibayar.');
    }
}
