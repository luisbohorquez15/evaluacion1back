<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = ['Cómics', 'Ropa', 'Coleccionables', 'Accesorios'];
        foreach ($categorias as $cat) {
            Categoria::firstOrCreate(['nombre' => $cat]);
        }
    }
}