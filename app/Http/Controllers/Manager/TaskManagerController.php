<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;

class TaskManagerController extends Controller
{
    /**
     * Pastikan user adalah manager
     */
    private function ensureManager()
    {
        if (Auth::user()->role->name !== 'manager') {
            abort(403);
        }
    }

    /**
     * Pastikan manager bagian dari project task
     */
    private function authorizeProject(Task $task)
    {
        if ($task->project->manager_id !== Auth::id()) {
        abort(403);
    }
    }

    /**
     * List task di project yang dia ikut
     */
    public function index()
    {
        $this->ensureManager();

        $tasks = Task::whereHas('project', function ($q) {
        $q->where('manager_id', Auth::id());
            })
            ->with(['project', 'assignee'])
            ->latest()
            ->get();

        return view('manager.tasks.index', compact('tasks'));
    }

    /**
     * Detail task
     */
    public function show(Task $task)
    {
        $this->ensureManager();
        $this->authorizeProject($task);

        $task->load(['project', 'assignee', 'reviews.reviewer']);

        return view('manager.tasks.show', compact('task'));
    }

    /**
     * Approve task
     */
    public function approve(Task $task)
    {
        $this->ensureManager();
        $this->authorizeProject($task);

        if ($task->status !== 'submitted') {
            abort(400, 'Task belum diajukan.');
        }

        $task->update(['status' => 'done']);

        TaskReview::create([
            'task_id'     => $task->id,
            'reviewer_id' => Auth::id(),
            'action'      => 'approved',
        ]);

        return back()->with('success', 'Task berhasil di-approve.');
    }

    /**
     * Kirim revisi
     */
    public function revision(Request $request, Task $task)
    {
        $this->ensureManager();
        $this->authorizeProject($task);

        $request->validate([
            'note' => 'required|string'
        ]);

        if ($task->status !== 'submitted') {
            abort(400, 'Task belum diajukan.');
        }

        $task->update(['status' => 'revision']);

        TaskReview::create([
            'task_id'     => $task->id,
            'reviewer_id' => Auth::id(),
            'action'      => 'revision',
            'note'        => $request->note,
        ]);

        return back()->with('success', 'Task dikembalikan untuk revisi.');
    }
    public function create()
{
    // Ambil project milik manager
    $projects = Project::with('members.user')
        ->where('manager_id', Auth::id())
        ->get();

    return view('manager.tasks.create', compact('projects'));
}
public function store(Request $request)
{
    $request->validate([
        'project_id'  => 'required|exists:projects,id',
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'assigned_to' => 'required|exists:users,id',
        'deadline'    => 'required|date|after_or_equal:today',
    ]);

    // Pastikan project milik manager
    $project = Project::where('manager_id', Auth::id())
        ->where('id', $request->project_id)
        ->firstOrFail();

    // Pastikan assigned user adalah member project
    $isMember = ProjectMember::where('project_id', $project->id)
        ->where('user_id', $request->assigned_to)
        ->exists();

    if (!$isMember) {
        return back()->withErrors([
            'assigned_to' => 'User bukan member project ini.'
        ])->withInput();
    }

    Task::create([
        'project_id'     => $project->id,
        'assigned_to'    => $request->assigned_to,
        'title'          => $request->title,
        'description'    => $request->description,
        'deadline'       => $request->deadline,
        'status'         => 'queue',      // default
        'pr_link'        => null,           // kosong saat dibuat
        'revision_count' => 0,              // awal 0
    ]);

    return redirect()
        ->route('manager.tasks.index')
        ->with('success', 'Task berhasil dibuat.');
}
}