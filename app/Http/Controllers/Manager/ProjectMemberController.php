<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    public function index(Project $project)
    {
        $members = $project->members()->with('user')->get();

        return view('manager.project_members.index', compact('project', 'members'));
    }

    public function create(Project $project)
    {
        $users = User::all(); // bebas semua user
        return view('manager.project_members.create', compact('project', 'users'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attr, $value, $fail) use ($project) {
                    if (ProjectMember::where('project_id', $project->id)
                        ->where('user_id', $value)->exists()) {
                        $fail('User sudah terdaftar di project ini.');
                    }
                }
            ],
            'role' => 'nullable|string'
        ]);

        ProjectMember::create([
            'project_id' => $project->id,
            'user_id' => $request->user_id,
            'role' => $request->role,
        ]);

        return redirect()
            ->route('manager.projects.members.index', $project->id)
            ->with('success', 'Member berhasil ditambahkan.');
    }

    public function edit(Project $project, ProjectMember $member)
    {
        $users = User::all();
        return view('manager.project_members.edit',
            compact('project', 'member', 'users'));
    }

    public function update(Request $request, Project $project, ProjectMember $member)
    {
        $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attr, $value, $fail) use ($project, $member) {
                    if (ProjectMember::where('project_id', $project->id)
                        ->where('user_id', $value)
                        ->where('id', '!=', $member->id)
                        ->exists()) {
                        $fail('User sudah terdaftar di project ini.');
                    }
                }
            ],
            'role' => 'nullable|string'
        ]);

        $member->update([
            'user_id' => $request->user_id,
            'role' => $request->role,
        ]);

        return redirect()
            ->route('manager.projects.members.index', $project->id)
            ->with('success', 'Member berhasil diperbarui.');
    }

    public function destroy(Project $project, ProjectMember $member)
    {
        $member->delete();

        return redirect()
            ->route('manager.projects.members.index', $project->id)
            ->with('success', 'Member berhasil dihapus.');
    }
}
