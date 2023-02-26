<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\TransferController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\BranchController;

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

Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('transfers', TransferController::class);
Route::apiResource('branches', BranchController::class);

// Searches api
Route::get('search', [TransferController::class, 'search']);
Route::post('/items/search/{lot}', [ItemController::class, 'search']);