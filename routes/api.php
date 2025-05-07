<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\JobOfferController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());  // Devuelve el usuario autenticado
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);





Route::middleware('auth:sanctum')->group(function () {
    // Ruta para crear una oferta laboral
    Route::post('/job-offers', [JobOfferController::class, 'create']);  // Solo accesible para reclutadores

    // Ruta para listar las ofertas laborales
    Route::get('/job-offers', [JobOfferController::class, 'index']);
});