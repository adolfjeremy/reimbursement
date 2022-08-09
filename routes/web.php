<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth-google');
Route::get('auth/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth-google-callback');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});

Route::prefix('admin')
->middleware('auth')
->middleware('isAdmin')
->group(function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::get('/edit/{id}', [AdminDashboardController::class, 'edit']);
    Route::get('/update/{id}', [AdminDashboardController::class, 'update']);
    Route::get('monthly-report', [AdminReportController::class, 'index'])->name('admin-report');
    Route::get('/edit/{id}', [AdminReportController::class, 'edit']);
    Route::get('/update/{id}', [AdminReportController::class, 'update']);
    Route::get('user-list', [AdminUserController::class, 'index'])->name('user-list');
    Route::get('/user-list/edit/{id}', [AdminUserController::class, 'edit']);
    Route::get('/user-list/update/{id}', [AdminUserController::class, 'update']);
    Route::get('/user-list/delete/{id}', [AdminUserController::class, 'destroy'])->name('delete-user');

});



Route::middleware('auth')->group( function() {
    Route::resource('user', UserController::class);
    Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly-report');
    Route::post('/monthly-report', [MonthlyReportController::class, 'store'])->name('monthly-report-store');
    Route::get('/monthly-report/{id}', [MonthlyReportController::class, 'destroy'])->name('monthly-report-destroy');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/', [DashboardController::class, 'store'])->name('dashboard-store');
    Route::get('/{id}', [DashboardController::class, 'destroy'])->name('dashboard-destroy');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

