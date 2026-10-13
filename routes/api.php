<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AdminController;

// Rutas Públicas
Route::post('/login', [AuthController::class, 'login']);
Route::get('/eventos', [EventoController::class, 'index']);

// Rutas Protegidas (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [AuthController::class, 'perfil']);
    Route::put('/eventos/{evento}', [EventoController::class, 'update']);
    Route::get('/admin/metricas', [AdminController::class, 'metricas']);
});