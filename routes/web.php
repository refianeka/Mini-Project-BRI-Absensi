<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ReportController;
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

// AUTHENTICATION
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('/');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    // LOGOUT
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // DASHBOARD OR ATTENDANCE
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::post('attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::put('attendance/update', [AttendanceController::class, 'update'])->name('attendance.update');
    // RIWAYAT ABSEN
    Route::get('history', [HistoryController::class, 'index'])->name('history');
});

Route::middleware(['auth', 'must.admin.staff.pj'])->group(function () {
    // GENERATE CODE
    Route::get('code', [CodeController::class, 'index'])->name('code');
    Route::post('code/generate', [CodeController::class, 'generate'])->name('code.generate');
});

Route::middleware(['auth', 'must.admin.staff'])->group(function () {
    // USER
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    // KELAS
    Route::get('class', [ClassController::class, 'index'])->name('class');
    Route::post('class/store', [ClassController::class, 'store'])->name('class.store');
    Route::put('class/update/{id}', [ClassController::class, 'update'])->name('class.update');
    Route::delete('class/delete/{id}', [ClassController::class, 'delete'])->name('class.delete');

    // MATERI
    Route::get('material', [MaterialController::class, 'index'])->name('material');
    Route::post('material/store', [MaterialController::class, 'store'])->name('material.store');
    Route::put('material/update/{id}', [MaterialController::class, 'update'])->name('material.update');
    Route::delete('material/delete/{id}', [MaterialController::class, 'delete'])->name('material.delete');

    // REPORT
    Route::get('report', [ReportController::class, 'index'])->name('report');
});
