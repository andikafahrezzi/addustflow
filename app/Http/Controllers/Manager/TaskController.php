<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (Auth::user()->role->name !== 'manager') {
                abort(403);
            }
            return $next($request);
        });
    }

    // 1️⃣ List task di project yang dia manage
    public function index()
    {
        $tasks = Task::whereHas('project.users', function ($q) {
                $q->where('users.id', Auth::id());
            })
            ->with(['project', 'assignee'])
            ->latest()
            ->get();

        return view('manager.tasks.index', compact('tasks'));
    }

    // 2️⃣ Detail task
    public function show(Task $task)
    {
        $this->authorizeProject($task);

        $task->load(['project', 'assignee', 'reviews.reviewer']);

        return view('manager.tasks.show', compact('task'));
    }

    // 3️⃣ Approve
    public function approve(Task $task)
    {
        $this->authorizeProject($task);

        if ($task->status !== 'submitted') {
            abort(400, 'Task belum diajukan.');
        }

        $task->update(['status' => 'approved']);

        TaskReview::create([
            'task_id'     => $task->id,
            'reviewer_id' => Auth::id(),
            'action'      => 'approved',
        ]);

        return back()->with('success', 'Task berhasil di-approve.');
    }

    // 4️⃣ Revisi
    public function revision(Request $request, Task $task)
    {
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

    // 🔐 Validasi manager bagian dari project
    private function authorizeProject(Task $task)
    {
        $exists = $task->project
            ->users()
            ->where('users.id', Auth::id())
            ->exists();

        if (!$exists) {
            abort(403);
        }
    }
}