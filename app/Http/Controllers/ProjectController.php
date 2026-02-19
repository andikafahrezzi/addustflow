<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Exports\ProjectsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['proposal', 'client'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('manager.projects.index', compact('projects'));
    }
    public function indexMembers()
    {
        $projects = Project::with(['proposal', 'client'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('manager.project_members.indexMembers', compact('projects'));
    }

    public function create()
    {
        // hanya proposal yang sudah approved
        $proposals = Proposal::where('status', 'approved')->get();

        return view('manager.projects.create', compact('proposals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required|exists:proposals,id',
            'repository_url' => 'nullable|url',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'budget'      => 'required|numeric|min:0',
        ]);

        $proposal = Proposal::with('lead')->findOrFail($request->proposal_id);

        Project::Create([
            'proposal_id'    => $proposal->id,
            'client_id'      => $proposal->lead->client_id,  // otomatis
            'name'           => $proposal->title,            // otomatis
            'repository_url' => $request->repository_url,   // input optional
            'contract_value' => $proposal->estimated_value,  // otomatis
            'budget'         => $request->budget,            // Manager input
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'status'         => 'planned',
            'manager_id'     => Auth::id(),
        ]);

        return redirect()->route('manager.projects.index')
            ->with('success', 'Project berhasil dibuat.');
    }

    public function edit(Project $project)
    {
        $proposals = Proposal::where('status', 'approved')->get();

        return view('manager.projects.edit', compact('project', 'proposals'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'proposal_id' => 'required|exists:proposals,id',
            'repository_url' => 'nullable|url',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'budget'      => 'required|numeric|min:0',
        ]);

        $proposal = Proposal::with('lead')->findOrFail($request->proposal_id);

        $project->update([
            'proposal_id'    => $proposal->id,
            'client_id'      => $proposal->lead->client_id,
            'name'           => $proposal->title,
            'repository_url' => $request->repository_url,
            'contract_value' => $proposal->estimated_value,
            'budget'         => $request->budget,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'status'         => $project->status, // tidak diubah
        ]);

        return redirect()->route('manager.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Project berhasil dihapus.');
    }

    // Export to Excel
    public function exportExcel()
    {
        return Excel::download(new ProjectsExport, 'projects.xlsx');
    }

    // Export to PDF
    public function exportPdf()
    {
        $projects = Project::with(['proposal.lead.client', 'manager'])->get();
        $pdf = Pdf::loadView('manager.projects.pdf', compact('projects'));

        return $pdf->download('projects.pdf');
    }
}
