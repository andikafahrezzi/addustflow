<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ClientController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ================= ADMIN =================

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/audit-logs', [AuditLogController::class, 'index'])
         ->name('admin.audit.logs');
});

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::patch('/admin/users/{user}/toggle-status',[UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });


    
    // ================= MANAGER =================
    Route::middleware('role:manager')->group(function () {
        Route::get('/manager/approvals', fn () => 'Approval Manager');
    });
    
    // ================= MARKETING =================
    Route::middleware('role:marketing')->group(function () {
        Route::get('/marketing/clients', fn () => 'Client Marketing');
        Route::get('/marketing/leads', fn () => 'Lead Marketing');
    });
   // routes/web.php
Route::prefix('marketing')->middleware('auth')->group(function() {
    Route::get('/clients', [ClientController::class, 'index'])->name('marketing.clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('marketing.clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('marketing.clients.store');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('marketing.clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('marketing.clients.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('marketing.clients.destroy');

    
    // export
    Route::get('/clients/export', [ClientController::class, 'export'])->name('marketing.clients.export');
});

    // ================= FINANCE =================
    Route::middleware('role:finance')->group(function () {
        Route::get('/finance/invoices', fn () => 'Invoice Finance');
        Route::get('/finance/payments', fn () => 'Payment Finance');
    });

    // ================= STAFF =================
    Route::middleware('role:staff')->group(function () {
        Route::get('/staff/projects', fn () => 'Project Staff');
    });

});
