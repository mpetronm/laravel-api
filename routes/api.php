<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

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
Route::get('/test-debug', function () {
    try {
        // Probar conexión a BD
        \DB::connection()->getPdo();
        $bd = "✅ Conexión a MySQL OK";
    } catch (\Exception $e) {
        $bd = "❌ Error MySQL: " . $e->getMessage();
    }
    
    // Probar modelo
    try {
        $count = \App\Models\Producto::count();
        $modelo = "✅ Modelo Producto OK (total: {$count})";
    } catch (\Exception $e) {
        $modelo = "❌ Error Modelo: " . $e->getMessage();
    }
    
    return response()->json([
        'status' => 'API funcionando',
        'database' => $bd,
        'model' => $modelo,
        'timestamp' => now(),
        'endpoints' => [
            'GET /api/productos' => 'Listar productos',
            'POST /api/productos' => 'Crear producto',
            'GET /api/productos/{id}' => 'Ver producto',
            'PUT /api/productos/{id}' => 'Actualizar',
            'DELETE /api/productos/{id}' => 'Eliminar'
        ]
    ]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta de prueba
Route::get('/test', function () {
    return ['status' => 'API funcionando'];
});

// Rutas CRUD de productos
Route::apiResource('productos', ProductoController::class);