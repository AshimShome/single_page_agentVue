<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentCustomerController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('agent')->group(function () {
    // Route::post('/customer/store',[AgentCustomerController::class,'Store'])->name('customer.store');
    // Route::get('/customer/get/district-data/{division_id}',[AgentCustomerController::class,'GetDistrictData']);
    // Route::get('customer/{customer_id}',[AgentCustomerController::class,'getcustomer']);
//    Route::post('/customer/update/',[AgentCustomerController::class,'Update'])->name('customer.update');

});