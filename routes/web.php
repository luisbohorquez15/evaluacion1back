<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckoutController;

// Página Principal (Catálogo)
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Gestión CRUD de Productos
Route::resource('productos', ProductoController::class);

// Carrito de compras
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/add/{id}', [CarritoController::class, 'add'])->name('carrito.add');
Route::patch('/carrito/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');