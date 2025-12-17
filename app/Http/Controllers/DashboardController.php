<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role->name;

        if ($role === 'admin') {
            return view('admin.dashboard');
        }

        if ($role === 'manager') {
            return view('manager.dashboard');
        }

        if ($role === 'marketing') {
            return view('marketing.dashboard');
        }

        if ($role === 'finance') {
            return view('finance.dashboard');
        }

        if ($role === 'staff') {
            return view('staff.dashboard');
        }

        abort(403);
    }
}
