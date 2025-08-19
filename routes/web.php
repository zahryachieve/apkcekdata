<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DashboardController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {

    Route::get('/validasidata', [DanaController::class, 'index'])->name('index');
Route::post('/upload-excel', [DanaController::class, 'uploadExcel'])->name('upload.excel');
Route::post('/upload-pdf', [DanaController::class, 'uploadPdf'])->name('upload.pdf');Route::delete('/reset', [DanaController::class, 'reset'])->name('reset');
Route::delete('/reset', [DanaController::class, 'reset'])->name('reset');
Route::get('/export', [DanaController::class, 'export'])->name('export');
Route::get('/dana/export-filtered', [DanaController::class, 'exportFiltered'])->name('dana.export.filtered');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
