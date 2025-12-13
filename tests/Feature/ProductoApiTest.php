<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test - Listar productos */
    public function puede_listar_productos()
    {
        $response = $this->get('/api/productos');
        $response->assertStatus(200);
    }

    /** @test - Crear producto */
    public function puede_crear_producto()
    {
        $data = [
            'nombre' => 'Producto Test',
            'precio' => 99.99,
            'descripcion' => 'Descripción test'
        ];

        $response = $this->postJson('/api/productos', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('productos', $data);
    }

    /** @test - Ver producto */
    public function puede_ver_producto_especifico()
    {
        // Primero crear un producto
        $producto = \App\Models\Producto::factory()->create();
        
        $response = $this->get("/api/productos/{$producto->id}");
        $response->assertStatus(200);
    }

    /** @test - Actualizar producto */
    public function puede_actualizar_producto()
    {
        $producto = \App\Models\Producto::factory()->create();
        
        $data = ['precio' => 150.50];
        
        $response = $this->putJson("/api/productos/{$producto->id}", $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('productos', $data);
    }

    /** @test - Eliminar producto */
    public function puede_eliminar_producto()
    {
        $producto = \App\Models\Producto::factory()->create();
        
        $response = $this->delete("/api/productos/{$producto->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('productos', ['id' => $producto->id]);
    }
}