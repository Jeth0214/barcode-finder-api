<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\TransferController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\UsersController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware('auth:sanctum')->group(function () {
    
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('transfers', TransferController::class);
});

// Route::controller(UsersController::class)->group( function() {
//     Route::post('login', 'login');
//     Route::post('logout', 'logout');
// });

// unrestricted Resource
Route::apiResource('branches', BranchController::class);
Route::post('login', [UsersController::class,'login']);
Route::get('logout', [UsersController::class, 'logout']);
