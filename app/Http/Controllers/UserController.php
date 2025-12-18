<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar user
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Form tambah user
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id'  => 'required|exists:roles,id',
        ]);

        User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'role_id'   => $data['role_id'],
            'is_active' => true,
        ]);
        audit_log(
            'create',
            'user',
            'Admin membuat user: ' . $data['email']
        );


        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Form edit user
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role_id'  => 'required|exists:roles,id',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role_id = $data['role_id'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        audit_log(
            'update',
            'user',
            'Admin mengubah user: ' . $user->email
        );


        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        // Optional: cegah hapus diri sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();
        audit_log(
            'delete',
            'user',
            'Admin menghapus user: ' . $user->email
        );


        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dihapus');
    }

    /**
     * Aktif / Nonaktif user
     */
    public function toggleStatus(User $user)
    {
        // Cegah menonaktifkan diri sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak bisa menonaktifkan akun sendiri');
        }

        $user->is_active = !$user->is_active;
        $user->save();
        audit_log(
            'update',
            'user',
            'Admin mengubah status user: ' . $user->email
        );

        return back()->with('success', 'Status user berhasil diubah');
    }
}
