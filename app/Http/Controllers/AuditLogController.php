<?php

namespace App\Http\Controllers;
   

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{


public function index()
{
    $logs = AuditLog::with('user')->latest()->get();
    // Sebelum
    $logs = AuditLog::with('user')->latest()->get();

    // Sesudah
    $logs = AuditLog::with('user')->latest()->paginate(20); // 20 = jumlah baris per halaman
    return view('admin.audit.index', compact('logs'));
}

}
