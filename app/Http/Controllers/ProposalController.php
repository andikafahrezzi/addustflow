<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Exports\ProposalsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with('lead.client')->latest()->get();
        return view('marketing.proposals.index', compact('proposals'));
    }

    public function create()
    {
        $leads = Lead::whereIn('status', ['qualified', 'contacted'])
                 ->orWhere('status', 'approved') // atau status tertentu
                 ->with('client')
                 ->get();
        return view('marketing.proposals.create', compact('leads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'estimated_value' => 'required|numeric|min:0',
            'status' => 'required|in:draft,submitted',
        ]);

        Proposal::create([
            'lead_id' => $request->lead_id,
            'title' => $request->title,
            'description' => $request->description,
            'estimated_value' => $request->estimated_value,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('marketing.proposals.index')->with('success', 'Proposal berhasil dibuat.');
    }

    public function edit(Proposal $proposal)
    {
        $leads = Lead::whereIn('status', ['qualified', 'contacted'])
                 ->orWhere('status', 'approved') // atau status tertentu
                 ->with('client')
                 ->get();
        return view('marketing.proposals.edit', compact('proposal', 'leads'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'estimated_value' => 'required|numeric|min:0',
            'status' => 'required|in:draft,submitted',
        ]);

        $proposal->update([
            'lead_id' => $request->lead_id,
            'title' => $request->title,
            'description' => $request->description,
            'estimated_value' => $request->estimated_value,
            'status' => $request->status,
        ]);

        return redirect()->route('marketing.proposals.index')->with('success', 'Proposal berhasil diperbarui.');
    }
    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return redirect()->route('marketing.proposals.index')
            ->with('success', 'Proposal berhasil dihapus.');
    }
    public function export()
    {
        return Excel::download(new ProposalsExport, 'proposals.xlsx');
    }
}
