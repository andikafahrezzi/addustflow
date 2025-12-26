<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Manager\ManagerProposalController;
use App\Http\Controllers\Manager\ProjectMemberController;

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
    // routes/web.php
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/proposals', [ManagerProposalController::class, 'index'])->name('manager.proposals.index');
    Route::post('/manager/proposals/{proposal}/approve', [ManagerProposalController::class, 'approve'])->name('manager.proposals.approve');
    Route::post('/manager/proposals/{proposal}/reject', [ManagerProposalController::class, 'reject'])->name('manager.proposals.reject');
});

Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->group(function () {

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('manager.projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('manager.projects.create');
    Route::get('/projects/show', [ProjectController::class, 'show'])->name('manager.projects.show');
    Route::post('/projects', [ProjectController::class, 'store'])->name('manager.projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('manager.projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('manager.projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('manager.projects.destroy');

    // Export
    Route::get('/projects/export/excel', [ProjectController::class, 'exportExcel'])
        ->name('manager.projects.export.excel');
    Route::get('/projects/export/pdf', [ProjectController::class, 'exportPdf'])
        ->name('manager.projects.export.pdf');
});
// ROUTE: Project Members (Manager Only)
Route::middleware(['auth','role:manager'])->group(function () {

    Route::prefix('manager/projects/{project}/members')->group(function () {

        Route::get('/', [ProjectMemberController::class, 'index'])
            ->name('manager.projects.members.index');

        Route::get('/create', [ProjectMemberController::class, 'create'])
            ->name('manager.projects.members.create');

        Route::post('/', [ProjectMemberController::class, 'store'])
            ->name('manager.projects.members.store');

        Route::get('/{member}/edit', [ProjectMemberController::class, 'edit'])
            ->name('manager.projects.members.edit');

        Route::put('/{member}', [ProjectMemberController::class, 'update'])
            ->name('manager.projects.members.update');

        Route::delete('/{member}', [ProjectMemberController::class, 'destroy'])
            ->name('manager.projects.members.destroy');
    });
});

    
    // ================= MARKETING =================
    Route::middleware('role:marketing')->group(function () {
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
Route::prefix('marketing')->middleware('auth')->group(function () {
    Route::get('/leads', [LeadController::class, 'index'])->name('marketing.leads.index');
    Route::get('/leads/create', [LeadController::class, 'create'])->name('marketing.leads.create');
    Route::post('/leads', [LeadController::class, 'store'])->name('marketing.leads.store');
    Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])->name('marketing.leads.edit');
    Route::put('/leads/{lead}', [LeadController::class, 'update'])->name('marketing.leads.update');
    Route::delete('/leads/{lead}', [LeadController::class, 'destroy'])->name('marketing.leads.destroy');
    Route::get('/leads/export/excel', [LeadController::class, 'exportExcel'])->name('marketing.leads.export.excel');
    Route::get('/leads/export/pdf', [LeadController::class, 'exportPdf'])->name('marketing.leads.export.pdf');
});

Route::prefix('marketing')->middleware(['auth'])->group(function() {
    Route::get('/proposals', [ProposalController::class, 'index'])->name('marketing.proposals.index');
    Route::get('/proposals/create', [ProposalController::class, 'create'])->name('marketing.proposals.create');
    Route::post('/proposals', [ProposalController::class, 'store'])->name('marketing.proposals.store');
    Route::get('/proposals/{proposal}/edit', [ProposalController::class, 'edit'])->name('marketing.proposals.edit');
    Route::put('/proposals/{proposal}', [ProposalController::class, 'update'])->name('marketing.proposals.update');
    Route::delete('/proposals/{proposal}', [ProposalController::class, 'destroy'])->name('marketing.proposals.destroy');

    Route::get('/proposals/export-excel', [ProposalController::class, 'exportExcel'])->name('marketing.proposals.exportExcel');
    Route::get('/proposals/export-pdf', [ProposalController::class, 'exportPDF'])->name('marketing.proposals.exportPDF');
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
