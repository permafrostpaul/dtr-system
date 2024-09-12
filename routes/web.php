<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WorkstationController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\EmployeeRequestController;
use App\Http\Controllers\AssignShiftController;
use App\Http\Controllers\ManageAccountController;
use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\AdminCalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ShiftController;



Route::get('/admin/signup', [AdminController::class, 'showSignupForm'])->name('admin-signup');
Route::post('/admin/signup', [AdminController::class, 'store'])->name('admin.signup.store');
Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/save-shifts', [ShiftController::class, 'saveShifts']);

// Public route for storing attendance summary
Route::post('/attendance/time-in', [AttendanceController::class, 'timeIn'])->name('attendance.timeIn');
Route::post('/attendance/time-out', [AttendanceController::class, 'timeOut'])->name('attendance.timeOut');
Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth')->name('notifications.index');
Route::get('/export-pdf', [ExportController::class, 'exportToPdf'])->name('export.pdf');




Route::post('/admin/store', [ManageAccountController::class, 'store'])->name('admin.store');
Route::put('/assign-shift', [AssignShiftController::class, 'update'])->name('assign-shift.update');
Route::put('/assign-shift/update-shift2', [AssignShiftController::class, 'updateShift2'])->name('assign-shift.update-shift2');
Route::put('/assign-shift/update-shift3', [AssignShiftController::class, 'updateShift3'])->name('assign-shift.update-shift3');


Route::post('/search/admin-accounts', [ManageAccountController::class, 'searchAdmins'])->name('search.admin.accounts');
Route::get('/search/pending-accounts', [ManageAccountController::class, 'searchPending'])->name('search.pending.accounts');

Route::post('/search/leave-requests', [EmployeeRequestController::class, 'search'])->name('search.leave-requests');

// Routes in web.php
Route::get('/full-calender', [EventController::class, 'fetchEvents']);
Route::post('/full-calender-ajax', [EventController::class, 'ajaxHandler']);
Route::get('/get-birthdays', [EventController::class, 'getBirthdays']);

// Employee routes 
Route::post('/attendance/employee/time-in', [AttendanceController::class, 'timeIn'])->name('attendance.timeIn');
Route::post('/attendance/employee/time-out', [AttendanceController::class, 'timeOut'])->name('attendance.timeOut');

// Admin routes
Route::post('/attendance/admin/time-in', [AdminAttendanceController::class, 'timeIn'])->name('attendance.admintimeIn');
Route::post('/attendance/admin/time-out', [AdminAttendanceController::class, 'timeOut'])->name('attendance.admintimeOut');

// Route for accepting a leave request
Route::post('/leave-request/{id}/accept', [EmployeeRequestController::class, 'acceptRequest'])->name('leave-request.accept');

// Route for declining a leave request
Route::post('/leave-request/{id}/decline', [EmployeeRequestController::class, 'declineRequest'])->name('leave-request.decline');


Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::post('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/profile/update-work-info', [ProfileController::class, 'updateWorkInfo'])->name('profile.updateWorkInfo');
    Route::get('/request-leave', [LeaveRequestController::class, 'index'])->name('request-leave');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::post('/request-leave/send', [LeaveRequestController::class, 'store'])->name('request-leave.store');
    Route::post('/attendance-summary', [AttendanceController::class, 'storeSummary']);
    Route::post('/attendance/toggle-time', [AttendanceController::class, 'toggleTime'])->name('attendance.toggleTime');
    Route::post('/attendance/save-remarks', [AttendanceController::class, 'saveRemarks'])->name('attendance.saveRemarks');
    
    Route::get('/workstations', [WorkstationController::class, 'index'])->name('workstations.index');
    Route::post('/workstations', [WorkstationController::class, 'store'])->name('workstations.store');
    Route::put('/workstations/{id}', [WorkstationController::class, 'update'])->name('workstations.update');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    Route::post('/attendance/filter', [AttendanceController::class, 'filterDTR'])->name('attendance.filter');

});

// Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
//     Route::get('attendance', [AdminAttendanceController::class, 'index'])->name('employee-dtr');
//     Route::post('attendance/time-in', [AdminAttendanceController::class, 'timeIn'])->name('attendance.timeIn');
//     Route::post('attendance/time-out', [AdminAttendanceController::class, 'timeOut'])->name('attendance.timeOut');
//     Route::get('attendance/filter', [AdminAttendanceController::class, 'filter'])->name('attendance.filter');
// });


// Route::middleware('auth')->prefix('admin')->group(function () {
//    
//     Route::post('/admin-profile/update-work-info', [AdminProfileController::class, 'updateWorkInfo'])->name('admin.profile.updateWorkInfo');
//     Route::post('/admin-profile/update-password', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.updatePassword');
//     Route::post('/admin-profile/destroy', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
// });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::get('/admin-profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::get('/admin-profile', [AdminProfileController::class, 'edit'])->name('admin-profile');
    Route::get('/assign-shift', [AssignShiftController::class, 'index'])->name('assign-shift');
    Route::get('/employee-dtr', [AdminAttendanceController::class, 'index'])->name('employee-dtr');
    Route::get('/manage-account', [ManageAccountController::class, 'index'])->name('manage-account');
    Route::get('/employee-request', [EmployeeRequestController::class, 'index'])->name('employee-request');
    Route::patch('/admin/profile/update-work-info', [AdminProfileController::class, 'updateWorkInfo'])->name('admin.profile.updateWorkInfo');
    Route::post('/admin-profile/update-password', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.updatePassword');
    Route::patch('/admin/profile/updatePersonal', [AdminProfileController::class, 'updatePersonal'])->name('admin.profile.updatePersonal');
    Route::get('/manage-accounts', [AccountManagementController::class, 'index'])->name('manage.accounts');
    Route::get('/employee-requests', [EmployeeRequestController::class, 'index'])->name('employee.requests');
    Route::get('/admin/assign-shift', [AssignShiftController::class, 'index'])->name('assign-shift.index');
    Route::post('/employee-dtr/filter', [AdminAttendanceController::class, 'filterEmployeeDTR'])->name('admin.employee-dtr.filter');
    Route::get('admin/pending-accounts', [ManageAccountController::class, 'showPendingAccounts'])->name('admin.pending-accounts');
    Route::post('admin/activate/{id}', [ManageAccountController::class, 'activateUser'])->name('admin.activate');
    Route::post('admin/deactivate/{id}', [ManageAccountController::class, 'deactivateUser'])->name('admin.deactivate');
    Route::get('/admin/manage-account', [ManageAccountController::class, 'showPendingAccounts'])->name('admin.manage-accounts');
    Route::get('/admin/admin-calendar', [AdminCalendarController::class, 'index'])->name('admin-calendar');
});


// Workstation routes

// Authentication routes
Route::get('/login', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// Authenticated user routes
// Home and dashboard routes
Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Include authentication routes
require __DIR__ . '/auth.php';
