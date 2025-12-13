<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Laptop Gamer',
            'precio' => 1500,
            'descripcion' => 'RTX 4080'
        ]);
        
        Producto::create([
            'nombre' => 'Mouse Razer',
            'precio' => 80,
            'descripcion' => 'RGB'
        ]);
        
        Producto::create([
            'nombre' => 'Teclado Mecánico',
            'precio' => 120,
            'descripcion' => 'Cherry MX'
        ]);
        
        echo "3 productos creados!\n";
    }
}