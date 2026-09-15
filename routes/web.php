<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\ExpansionController;
use App\Http\Controllers\BusquedaController;

// Vista de Búsqueda Avanzada (Página Principal)
Route::get('/', [BusquedaController::class, 'index'])->name('busqueda.index');

// Rutas para Idiomas
Route::get('/idiomas', [IdiomaController::class, 'index'])->name('idiomas.index');
Route::get('/idiomas/crear', [IdiomaController::class, 'create'])->name('idiomas.create');
Route::post('/idiomas', [IdiomaController::class, 'store'])->name('idiomas.store');
Route::get('/idiomas/{idioma}', [IdiomaController::class, 'show'])->name('idiomas.show');
Route::put('/idiomas/{idioma}', [IdiomaController::class, 'update'])->name('idiomas.update');
Route::delete('/idiomas/{idioma}', [IdiomaController::class, 'destroy'])->name('idiomas.destroy');

// Rutas para Juegos
Route::get('/juegos', [JuegoController::class, 'index'])->name('juegos.index');
Route::get('/juegos/crear', [JuegoController::class, 'create'])->name('juegos.create');
Route::post('/juegos', [JuegoController::class, 'store'])->name('juegos.store');
Route::get('/juegos/{juego}', [JuegoController::class, 'show'])->name('juegos.show');
Route::put('/juegos/{juego}', [JuegoController::class, 'update'])->name('juegos.update');
Route::delete('/juegos/{juego}', [JuegoController::class, 'destroy'])->name('juegos.destroy');

// Rutas para Expansiones
Route::get('/expansiones', [ExpansionController::class, 'index'])->name('expansiones.index');
Route::get('/expansiones/crear', [ExpansionController::class, 'create'])->name('expansiones.create');
Route::post('/expansiones', [ExpansionController::class, 'store'])->name('expansiones.store');
Route::get('/expansiones/{expansion}', [ExpansionController::class, 'show'])->name('expansiones.show');
Route::put('/expansiones/{expansion}', [ExpansionController::class, 'update'])->name('expansiones.update');
Route::delete('/expansiones/{expansion}', [ExpansionController::class, 'destroy'])->name('expansiones.destroy');