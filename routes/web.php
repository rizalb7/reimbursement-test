<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\UsersController;
use App\Models\Reimbursement;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
    Route::resource('reimbursement', ReimbursementController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:direktur'])->group(function () {
    Route::resource('users', UsersController::class);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:direktur|finance'])->group(function () {
    Route::post('/reimbursement/acc/{reimbursement}', [ReimbursementController::class, 'acc'])->name('acc');
    Route::post('/reimbursement/deny/{reimbursement}', [ReimbursementController::class, 'deny'])->name('deny');
});

require __DIR__.'/auth.php';
