<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dasboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::controller(App\Http\Controllers\ReimbursementController::class)->group(function () {
    Route::get('/reimbursement', 'index');
    Route::get('/reimbursement/create', 'create')->name('reimbursement.create');
    Route::post('/reimbursement', 'store')->name('reimbursement.store');
    Route::post('/reimbursement/approved/{reimbursement}', 'approved')->name('reimbursement.approved');
    Route::post('/reimbursement/rejected/{reimbursement}', 'rejected')->name('reimbursement.rejected');
    Route::get('/reimbursement/{reimbursement}', 'show')->name('reimbursement.show');
    Route::get('/reimbursement/{reimbursement}/edit', 'edit')->name('reimbursement.edit');
    Route::put('/reimbursement/{reimbursement}', 'update')->name('reimbursement.update');
    Route::delete('/reimbursement/{reimbursement}', 'destroy')->name('reimbursement.destroy');
    
});
Route::controller(App\Http\Controllers\EmployeeController::class)->group(function () {
    Route::get('/employee', 'index');
    Route::get('/employee/create', 'create')->name('employee.create');
    Route::post('/employee', 'store')->name('employee.store');
    Route::get('/employee/{user}', 'show')->name('employee.show');
    Route::get('/employee/{user}/edit', 'edit')->name('employee.edit');
    Route::put('/employee/{user}', 'update')->name('employee.update');
    Route::delete('/employee/{user}', 'destroy')->name('employee.destroy');
    
});