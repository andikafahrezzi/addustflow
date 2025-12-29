<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerProposalController extends Controller
{
    public function index()
    {
        // Ambil proposal yang statusnya submitted, approved, atau rejected
        $proposals = Proposal::with('lead.client')
                             ->whereIn('status', ['submitted', 'approved', 'rejected'])
                             ->latest()
                             ->get();
        
        return view('manager.proposals.index', compact('proposals'));
    }

    public function approve(Proposal $proposal)
    {
        if ($proposal->status !== 'submitted') {
            return back()->with('error', 'Proposal ini tidak bisa di-approve.');
        }

        // Simpan approval
        Approval::create([
            'approvable_type' => Proposal::class,
            'approvable_id'   => $proposal->id,
            'status'          => 'approved',
            'approved_by'     => Auth::id(),
            'approved_at'     => now(),
            'note'            => null,
        ]);

        // Update status proposal
        $proposal->update([
            'status'      => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Proposal berhasil di-approve.');
    }

    public function reject(Request $request, Proposal $proposal)
    {
        if ($proposal->status !== 'submitted') {
            return back()->with('error', 'Proposal ini tidak bisa di-reject.');
        }

        Approval::create([
            'approvable_type' => Proposal::class,
            'approvable_id'   => $proposal->id,
            'status'          => 'rejected',
            'approved_by'     => Auth::id(),
            'approved_at'     => now(),
            'note'            => $request->note,
        ]);

        $proposal->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Proposal berhasil ditolak.');
    }
}
