<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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

// Get Payment
Route::get('/', [PaymentController::class, 'index']);
// Post Payment
Route::post('/post', [PaymentController::class, 'store'])->name('storePayment');
// Delete Payment
Route::post('/delete', [PaymentController::class, 'delete']);
