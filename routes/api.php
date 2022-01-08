<?php

use App\Http\Controllers\Api\PegawaiControlller;
use App\Http\Controllers\Api\GajiPegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/pegawai', [PegawaiControlller::class, 'index'      ]);
Route::post('/pegawai', [PegawaiControlller::class, 'store'      ]);


Route::get('/gaji-pegawai', [GajiPegawaiController::class, 'index'      ]);
Route::post('/gaji-pegawai', [GajiPegawaiController::class, 'store'      ]);
Route::post('/gaji-pegawai/batch', [GajiPegawaiController::class, 'batch'      ]);
