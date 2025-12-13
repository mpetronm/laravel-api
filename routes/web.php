<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

// Ruta principal - Interfaz CRUD
Route::get('/', function () {
    return view('productos.admin');
});

// También puedes mantener las rutas API para web (opcional)
Route::resource('productos', ProductoController::class);
Route::get('/crud-real', function () {
    return view('crud_real');
});