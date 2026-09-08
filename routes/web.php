<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\ExpansionController;

Route::get('/', [BaseController::class, 'index']);

// Rutas Idiomas
Route::get('/idiomas', [IdiomaController::class, 'index'])->name('idiomas.index');
Route::get('/idiomas/create', [IdiomaController::class, 'create'])->name('idiomas.create');
Route::post('/idiomas', [IdiomaController::class, 'store'])->name('idiomas.store');
Route::get('/idiomas/{id}', [IdiomaController::class, 'show'])->name('idiomas.show');
Route::delete('/idiomas/{id}', [IdiomaController::class, 'destroy'])->name('idiomas.destroy');

// Rutas Juegos
Route::get('/juegos', [JuegoController::class, 'index'])->name('juegos.index');
Route::get('/juegos/create', [JuegoController::class, 'create'])->name('juegos.create');
Route::post('/juegos', [JuegoController::class, 'store'])->name('juegos.store');
Route::get('/juegos/{id}', [JuegoController::class, 'show'])->name('juegos.show');
Route::delete('/juegos/{id}', [JuegoController::class, 'destroy'])->name('juegos.destroy');

// Rutas Expansiones
Route::get('/expansiones', [ExpansionController::class, 'index'])->name('expansiones.index');
Route::get('/expansiones/create', [ExpansionController::class, 'create'])->name('expansiones.create');
Route::post('/expansiones', [ExpansionController::class, 'store'])->name('expansiones.store');
Route::get('/expansiones/{id}', [ExpansionController::class, 'show'])->name('expansiones.show');
Route::delete('/expansiones/{id}', [ExpansionController::class, 'destroy'])->name('expansiones.destroy');