<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RuteController;
use App\Http\Controllers\Api\PerjalananController;

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

Route::post('login', [AuthController::class, 'login']);

Route::controller(PerjalananController::class)->group(function () {

    Route::post('rencana-perjalanan', 'perjalanan');

    Route::get('list-perjalanan-sales/{sales_id}', 'list_perjalanan_sales');

    Route::get('list-customer-tujuan/{sales_id}/{perjalanan_id}', 'list_customer_tujuan');
});

Route::controller(RuteController::class)->group(function () {

    Route::post('tambah-rute-perjalanan', 'tambah_rute');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
