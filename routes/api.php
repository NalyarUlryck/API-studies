<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/users',[UserController::class, 'index']);


// Aqui estou apenas fazendo um teste com a rota:
Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
