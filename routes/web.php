<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transaction;

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

Route::get('/home', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
Route::get('/api/transactions', [App\Http\Controllers\TransactionController::class, 'api'])->name('transaction');


Route::get('/transaction/create', [App\Http\Controllers\TransactionController::class, 'create']);
Route::post('/transaction/store', [App\Http\Controllers\TransactionController::class, 'store']);
Route::get('/transaction/{id}/edit', [App\Http\Controllers\TransactionController::class, 'edit']);
Route::put('/transaction/{id}', [App\Http\Controllers\TransactionController::class, 'update']);
Route::delete('/transaction/{transaction}', [App\Http\Controllers\TransactionController::class, 'destroy']);
