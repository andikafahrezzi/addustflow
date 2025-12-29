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
use App\Http\Controllers\Manager\ManagerExpenseController;
use App\Http\Controllers\FinanceExpenseController;
use App\Http\Controllers\Manager\InvoiceController as ManagerInvoiceController;
use App\Http\Controllers\FinanceInvoiceController;
use App\Http\Controllers\FinancePaymentController;
use App\Http\Controllers\HREmployeeController;
use App\Http\Controllers\HRSalaryController;





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

// EXPENSES (Manager)
Route::prefix('manager/projects/{project}/expenses')
    ->name('manager.projects.expenses.')
    ->group(function () {

    Route::get('/', [ManagerExpenseController::class, 'index'])->name('index');

    Route::get('/create', [ManagerExpenseController::class, 'create'])->name('create');
    Route::post('/', [ManagerExpenseController::class, 'store'])->name('store');

    Route::get('/{expense}/edit', [ManagerExpenseController::class, 'edit'])->name('edit');
    Route::put('/{expense}', [ManagerExpenseController::class, 'update'])->name('update');

    Route::delete('/{expense}', [ManagerExpenseController::class, 'destroy'])->name('destroy');
});

Route::prefix('manager')->name('manager.')->group(function () {

    // List invoice per project
    Route::get('projects/{project}/invoices', 
        [ManagerInvoiceController::class, 'index'])
        ->name('invoices.index');

    // Create invoice
    Route::get('projects/{project}/invoices/create', 
        [ManagerInvoiceController::class, 'create'])
        ->name('invoices.create');

    Route::post('projects/{project}/invoices', 
        [ManagerInvoiceController::class, 'store'])
        ->name('invoices.store');
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

    Route::prefix('finance')->name('finance.')->group(function () {

        // list semua project
        Route::get('/projects', [FinanceExpenseController::class, 'index'])
            ->name('projects.index');

        // detail project (tampilkan semua expenses)
        Route::get('/projects/{project}', [FinanceExpenseController::class, 'show'])
            ->name('projects.show');

        // approve/reject 1 expense
        Route::post('/expenses/{expense}/approve', [FinanceExpenseController::class, 'approve'])
            ->name('expenses.approve');

        Route::post('/expenses/{expense}/reject', [FinanceExpenseController::class, 'reject'])
            ->name('expenses.reject');

        // approve/reject ALL expenses in project
        Route::post('/projects/{project}/expenses/approve-all',
            [FinanceExpenseController::class, 'approveAll'])
            ->name('expenses.approveAll');

        Route::post('/projects/{project}/expenses/reject-all',
            [FinanceExpenseController::class, 'rejectAll'])
            ->name('expenses.rejectAll');
    });
Route::prefix('finance')->name('finance.')->group(function () {

    // List semua project yang punya invoice
    Route::get('invoices/projects', 
        [FinanceInvoiceController::class, 'projectList'])
        ->name('invoices.projects');

    // List semua invoice berdasarkan project
    Route::get('invoices/{project}', 
        [FinanceInvoiceController::class, 'index'])
        ->name('invoices.index');

    // Approve invoice
    Route::put('invoices/{invoice}/approve', 
        [FinanceInvoiceController::class, 'approve'])
        ->name('invoices.approve');

    // Reject invoice
    Route::put('invoices/{invoice}/reject', 
        [FinanceInvoiceController::class, 'reject'])
        ->name('invoices.reject');

    // Bulk approve all invoices of a project
    Route::put('invoices/{project}/approve-all', 
        [FinanceInvoiceController::class, 'approveAll'])
        ->name('invoices.approveAll');

    // Bulk reject all invoices of a project
    Route::put('invoices/{project}/reject-all', 
        [FinanceInvoiceController::class, 'rejectAll'])
        ->name('invoices.rejectAll');
});


Route::prefix('finance')->middleware(['auth','role:finance'])->group(function () {

    // daftar semua invoice
    Route::get('/invoices', [FinanceInvoiceController::class, 'index'])
        ->name('finance.invoices.index');

    // detail invoice termasuk list expenses
    Route::get('/invoices/client/{invoice}', [FinanceInvoiceController::class, 'show'])
        ->name('finance.invoices.showClient');

    // approve invoice (ubah status → approved)
    Route::post('/invoices/client/{invoice}/approve', [FinanceInvoiceController::class, 'approve'])
        ->name('finance.invoices.approve');

    // send invoice ke client (ubah status → sent)
    Route::post('/invoices/client/{invoice}/send', [FinanceInvoiceController::class, 'send'])
        ->name('finance.invoices.send');

    // mark as paid
    Route::post('/invoices/client/{invoice}/paid', [FinanceInvoiceController::class, 'paid'])
        ->name('finance.invoices.paid');
});
// routes/web.php

Route::prefix('finance')->middleware(['auth','role:finance'])->group(function () {

    // ✔ GLOBAL payment list
    Route::get('/payments', 
        [FinancePaymentController::class, 'all'])
        ->name('finance.payments.all');

    // ✔ Payment per invoice
    Route::get('/invoice/{invoice}/payments', 
        [FinancePaymentController::class, 'index'])
        ->name('finance.payments.index');

    // Tambah payment
    Route::get('/invoice/{invoice}/payments/create', 
        [FinancePaymentController::class, 'create'])
        ->name('finance.payments.create');

    // Simpan payment
    Route::post('/invoice/{invoice}/payments', 
        [FinancePaymentController::class, 'store'])
        ->name('finance.payments.store');

    // Hapus payment
    Route::delete('/invoice/{invoice}/payments/{payment}', 
        [FinancePaymentController::class, 'destroy'])
        ->name('finance.payments.destroy');
});



    // ================= STAFF =================
    Route::middleware('role:staff')->group(function () {
        Route::get('/staff/projects', fn () => 'Project Staff');
    });

    // ================= HR =================
    Route::prefix('hr')->middleware(['auth','role:hr'])->group(function () {

        // List employees
        Route::get('/employees', [HREmployeeController::class, 'index'])
            ->name('hr.employees.index');

        // Create
        Route::get('/employees/create', [HREmployeeController::class, 'create'])
            ->name('hr.employees.create');
        Route::post('/employees', [HREmployeeController::class, 'store'])
            ->name('hr.employees.store');

        // Edit
        Route::get('/employees/{employee}/edit', [HREmployeeController::class, 'edit'])
            ->name('hr.employees.edit');
        Route::put('/employees/{employee}', [HREmployeeController::class, 'update'])
            ->name('hr.employees.update');

        // Nonaktifkan
        Route::put('/employees/{employee}/deactivate', [HREmployeeController::class, 'deactivate'])
            ->name('hr.employees.deactivate');

        // Hapus permanen
        Route::delete('/employees/{employee}', [HREmployeeController::class, 'destroy'])
            ->name('hr.employees.destroy');
    });


Route::prefix('hr')->middleware(['auth', 'role:hr'])->group(function () {

    // list salary per employee
    Route::get('/employees/{employee}/salaries', 
        [HRSalaryController::class, 'index'])
        ->name('hr.salaries.index');

    // form tambah salary
    Route::get('/employees/{employee}/salaries/create',
        [HRSalaryController::class, 'create'])
        ->name('hr.salaries.create');

    // simpan salary
    Route::post('/employees/{employee}/salaries',
        [HRSalaryController::class, 'store'])
        ->name('hr.salaries.store');

    // edit salary
    Route::get('/salaries/{salary}/edit',
        [HRSalaryController::class, 'edit'])
        ->name('hr.salaries.edit');

    // update salary
    Route::put('/salaries/{salary}',
        [HRSalaryController::class, 'update'])
        ->name('hr.salaries.update');

    // delete salary
    Route::delete('/salaries/{salary}',
        [HRSalaryController::class, 'destroy'])
        ->name('hr.salaries.destroy');
});

});
