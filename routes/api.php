<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::patch('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'showOneUser']);
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);

// Aqui estou apenas fazendo um teste com a rota:
Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
