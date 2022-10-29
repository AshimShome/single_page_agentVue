<?php

use App\Http\Controllers\AgentCustomerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[AgentCustomerController::class,'CustomerViewPage'])->name('customer.view');

Route::prefix('agent')->group(function () {
    Route::post('/customer/store',[AgentCustomerController::class,'storeCustomer']);
    Route::get('/customer/getData',[AgentCustomerController::class,'CustomergetData'])->name('customer.store');
    Route::get('/customer/edit/{customer_id}',[AgentCustomerController::class,'editCustomer'])->name('customer.edit');
    Route::post('/customer/update/{customer_id}',[AgentCustomerController::class,'updateCustomer'])->name('customer.update');
    Route::get('/customer/delete/{customer_id}',[AgentCustomerController::class,'delete']);

});
