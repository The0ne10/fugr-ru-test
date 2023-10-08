<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/notebook', [\App\Http\Controllers\Api\V1\IndexController::class, 'index']);
Route::post('/notebook', [\App\Http\Controllers\Api\V1\IndexController::class, 'store']);
Route::get('/notebook/{id}', [\App\Http\Controllers\Api\V1\IndexController::class, 'show']);
Route::patch('/notebook/{id}', [\App\Http\Controllers\Api\V1\IndexController::class, 'update']);
Route::delete('/notebook/{id}', [\App\Http\Controllers\Api\V1\IndexController::class, 'delete']);

Route::post('/image', [\App\Http\Controllers\Api\V1\NotebookImageController::class, 'store']);


