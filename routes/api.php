<?php

use App\Http\Controllers\Api\LaguController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// get Lagu Daerah
Route::get('/lagudaerah', [LaguController::class, 'index']);

// post Lagu Daerah
Route::post('/lagudaerah', [LaguController::class, 'create']);

// update Lagu Daerah
Route::post('/lagudaerah/update/{id}', [LaguController::class, 'update']);

// delete Lagu Daerah
Route::delete('/lagudaerah/{id}', [LaguController::class, 'delete']);
