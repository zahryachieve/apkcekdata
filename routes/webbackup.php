<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DanaController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DanaController::class, 'index'])->name('index');
Route::post('/upload-excel', [DanaController::class, 'uploadExcel'])->name('upload.excel');
Route::post('/upload-pdf', [DanaController::class, 'uploadPdf'])->name('upload.pdf');Route::delete('/reset', [DanaController::class, 'reset'])->name('reset');
Route::delete('/reset', [DanaController::class, 'reset'])->name('reset');
Route::get('/export', [DanaController::class, 'export'])->name('export');
Route::get('/dana/export-filtered', [DanaController::class, 'exportFiltered'])->name('dana.export.filtered');
