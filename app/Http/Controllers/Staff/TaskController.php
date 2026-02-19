<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // List semua task milik staff
    public function index()
    {
        $tasks = Task::where('assigned_to', Auth::id())
            ->with('project')
            ->latest()
            ->get();

        return view('staff.tasks.index', compact('tasks'));
    }

    // Detail task
    public function show(Task $task)
    {
        // Pastikan task memang milik staff
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $task->load(['project', 'reviews.reviewer']);

        return view('staff.tasks.show', compact('task'));
    }

    // Update status oleh staff
    public function updateStatus(Request $request, Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:in_progress,submitted',
            'pr_link' => 'nullable|string',
            'note' => 'nullable|string'
        ]);
        if ($request->status === 'in_progress' 
            && !in_array($task->status, ['queue', 'revision'])) {
            abort(400, 'Transisi status tidak valid.');
        }

        if ($request->status === 'submitted' 
            && $task->status !== 'in_progress') {
            abort(400, 'Task belum dikerjakan.');
        }
        
        $task->update([
            'status'  => $request->status,
            'pr_link' => $request->pr_link ?? $task->pr_link,
        ]);

        // Jika ajukan
        if ($request->status === 'submitted') {
            TaskReview::create([
                'task_id'     => $task->id,
                'reviewer_id' => Auth::id(),
                'action'      => 'submitted',
                'note'        => $request->note,
            ]);
        }

        return redirect()->route('staff.tasks.show', $task->id)
            ->with('success', 'Status berhasil diperbarui.');
    }
}