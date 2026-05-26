<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// Browse events - accessible to all authenticated users
Route::get('/events/browse', [EventController::class, 'browse'])
    ->middleware('auth')
    ->name('events.browse');

// Admin/Organizer event management
Route::resource('events', EventController::class);

// Registrations
Route::middleware('auth')->group(function () {
    Route::get('/my-registrations', [RegistrationController::class, 'myRegistrations'])
        ->name('registrations.my');
    Route::get('/registrations/manage', [RegistrationController::class, 'manageRegistrations'])
        ->middleware('role:admin,organizer')
        ->name('registrations.manage');
    Route::post('/registrations', [RegistrationController::class, 'store'])
        ->name('registrations.store');
    Route::post('/registrations/{registration}/pay', [RegistrationController::class, 'pay'])
        ->name('registrations.pay');
    Route::patch('/registrations/{registration}', [RegistrationController::class, 'updateStatus'])
        ->name('registrations.update');
    Route::post('/registrations/{registration}/cancel', [RegistrationController::class, 'cancel'])
        ->name('registrations.cancel');
});

// Volunteers
Route::resource('volunteers', VolunteerController::class)
    ->middleware('role:admin,organizer');
Route::patch('/volunteers/{volunteer}/status', [VolunteerController::class, 'updateStatus'])
    ->name('volunteers.updateStatus');

// Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::patch('/users/{user}', [UserController::class, 'updateStatus'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/accounts', [UserController::class, 'roleAccounts'])->name('users.roleAccounts');

// Reports & Activity Logs
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');