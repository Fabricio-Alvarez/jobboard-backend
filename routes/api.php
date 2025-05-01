<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());  // Devuelve el usuario autenticado
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
