<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\LeaveManagement\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\LeaveManagement\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\LeaveManagement\DepartmentHead\DashboardController as DeptHeadDashboardController;
use App\Http\Controllers\LeaveManagement\DepartmentHead\LeaveApprovalController as DeptHeadLeaveApprovalController;
use App\Http\Controllers\LeaveManagement\HrAdmin\DashboardController as HrAdminDashboardController;
use App\Http\Controllers\LeaveManagement\HrAdmin\LeaveApprovalController as HrAdminLeaveApprovalController;
use App\Http\Controllers\LeaveManagement\LeaveTypeController;
use App\Http\Controllers\ApprovalWorkflow\ApprovalSummaryController;
use App\Http\Controllers\CalendarScheduling\CalendarController;
use App\Http\Controllers\CalendarScheduling\DepartmentCalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes (protected)
Route::middleware('auth')->group(function () {
    
    // Password Change Routes
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.update');
    
    // Employee Routes
    Route::prefix('employee')->group(function () {
        // Dashboard
        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
        Route::get('/leave-balance', [EmployeeDashboardController::class, 'balance'])->name('employee.leave.balance');
        Route::get('/team-calendar', [CalendarController::class, 'index'])->name('employee.team.calendar');
        Route::get('/profile', [UserController::class, 'profile'])->name('employee.profile');
        Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('users.edit-profile');
        Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('users.update-profile');
        
        // Leave Management
        Route::get('/apply-leave', [EmployeeLeaveController::class, 'create'])->name('employee.leave.create');
        Route::post('/apply-leave', [EmployeeLeaveController::class, 'store'])->name('employee.leave.store');
        Route::get('/leave-history', [EmployeeLeaveController::class, 'index'])->name('employee.leave.history');
        Route::get('/leave/{id}/edit', [EmployeeLeaveController::class, 'edit'])->name('employee.leave.edit');
        Route::get('/leave/{id}', [EmployeeLeaveController::class, 'show'])->name('employee.leave.show');
        Route::put('/leave/{id}', [EmployeeLeaveController::class, 'update'])->name('employee.leave.update');
        Route::post('/leave/{id}/retrieve', [EmployeeLeaveController::class, 'retrieve'])->name('employee.leave.retrieve');
        Route::post('/leave/{id}/cancel', [EmployeeLeaveController::class, 'cancel'])->name('employee.leave.cancel');
    });

    // Department Head Routes
    Route::prefix('head')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DeptHeadDashboardController::class, 'index'])->name('head.dashboard');
        Route::get('/dashboard-stats', [DeptHeadDashboardController::class, 'getDashboardStats'])->name('head.dashboard.stats');
        
        // Leave Actions (Approval/Rejection)
        Route::post('/approve/{id}', [DeptHeadDashboardController::class, 'approveLeave'])->name('head.approve');
        Route::post('/reject/{id}', [DeptHeadDashboardController::class, 'rejectLeave'])->name('head.reject');
        
        // Leave Management Pages
        Route::get('/pending-leaves', [DeptHeadLeaveApprovalController::class, 'pending'])->name('head.leaves.pending');
        Route::get('/leave-history', [DeptHeadLeaveApprovalController::class, 'history'])->name('head.leaves.history');
        Route::get('/leave/{id}', [DeptHeadLeaveApprovalController::class, 'show'])->name('head.leave.details');
        
        // Calendar
        Route::get('/team-calendar', [DepartmentCalendarController::class, 'index'])->name('head.team.calendar');
        Route::get('/calendar', [CalendarController::class, 'index'])->name('head.calendar');
        
        // Management Pages
        Route::get('/reports', [DeptHeadDashboardController::class, 'reports'])->name('head.reports');
        Route::get('/team-members', [DeptHeadDashboardController::class, 'teamMembers'])->name('head.team.members');
        Route::get('/leave-policies', [DeptHeadDashboardController::class, 'leavePolicies'])->name('head.leave.policies');
    });

    // HR Admin Routes
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [HrAdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/reports', [HrAdminDashboardController::class, 'reports'])->name('admin.reports');
        Route::get('/settings', [HrAdminDashboardController::class, 'settings'])->name('admin.settings');
        
        // Employee Management
        Route::get('/employees', [UserController::class, 'index'])->name('admin.employees');
        Route::get('/employees/create', [UserController::class, 'create'])->name('admin.employees.create');
        Route::post('/employees', [UserController::class, 'store'])->name('admin.employees.store');
        Route::get('/employees/{id}/edit', [UserController::class, 'edit'])->name('admin.employees.edit');
        
        // Leave Management
        Route::get('/pending-approvals', [HrAdminLeaveApprovalController::class, 'pending'])->name('admin.leaves.pending');
        Route::get('/leave-history', [HrAdminLeaveApprovalController::class, 'history'])->name('admin.leaves.history');
        Route::get('/approval-summary', [ApprovalSummaryController::class, 'index'])->name('admin.approval.summary');
        
        // System Management
        Route::get('/departments', [UserController::class, 'departments'])->name('admin.departments');
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles');
        Route::get('/leave-types', [LeaveTypeController::class, 'index'])->name('admin.leave.types');
    });

    // User Management Routes (separate from admin)
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    });

    // Shared Calendar Routes
    Route::prefix('calendar')->group(function () {
        Route::get('/', [CalendarController::class, 'index'])->name('calendar.index');
        Route::get('/department', [DepartmentCalendarController::class, 'index'])->name('calendar.department');
    });
});