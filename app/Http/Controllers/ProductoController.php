<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Listar todos los productos
     * GET /api/productos
     */
    public function index()
    {
        return Producto::all();
    }

    /**
     * Crear un nuevo producto
     * POST /api/productos
     */
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string'
        ]);

        // Crear producto
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion
        ]);
        
        // Devolver respuesta
        return response()->json($producto, 201);
    }

    /**
     * Mostrar un producto específico
     * GET /api/productos/{id}
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        
        return $producto;
    }

    /**
     * Actualizar un producto
     * PUT /api/productos/{id}
     */
    public function update(Request $request, $id)
    {
        // Buscar producto
        $producto = Producto::find($id);
        
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        
        // Validar
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'precio' => 'sometimes|numeric|min:0',
            'descripcion' => 'nullable|string'
        ]);

        // Actualizar solo los campos enviados
        if ($request->has('nombre')) {
            $producto->nombre = $request->nombre;
        }
        
        if ($request->has('precio')) {
            $producto->precio = $request->precio;
        }
        
        if ($request->has('descripcion')) {
            $producto->descripcion = $request->descripcion;
        }
        
        $producto->save();
        
        return response()->json($producto);
    }

    /**
     * Eliminar un producto
     * DELETE /api/productos/{id}
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        
        $producto->delete();
        
        return response()->json(['message' => 'Producto eliminado'], 200);
    }
}