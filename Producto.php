<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

class Producto //extends Model
{
    private array $productos = [
        
        [
            'id' => 1,
            'nombre' => 'El principito',
            'descripcion' => 'Libro de literatura infantil y juvenil escrito por Antoine de Saint-Exupéry.',
            'precio' => 15000,
            'imagen' => 'https://images.cdn3.buscalibre.com/fit-in/360x360/0e/6f/0e6f5c7b8a4d9c1b2e5f8c1e3f4a5b6c.jpg',
        ],
        [
            'id' => 2,
            'nombre' => 'Cien años de soledad',
            'descripcion' => 'Novela del escritor colombiano Gabriel García Márquez, publicada en 1967.',
            'precio' => 20000,
            'imagen' => 'https://images.cdn3.buscalibre.com/fit-in/360x360/0e/6f/0e6f5c7b8a4d9c1b2e5f8c1e3f4a5b6c.jpg',
        ],
        [
            'id' => 3,
            'nombre' => 'Don Quijote de la Mancha',
            'descripcion' => 'Novela escrita por Miguel de Cervantes Saavedra, publicada en dos partes en 1605 y 1615.',
            'precio' => 25000,
            'imagen' => 'https://images.cdn3.buscalibre.com/fit-in/360x360/0e/6f/0e6f5c7b8a4d9c1b2e5f8c1e3f4a5b6c.jpg',
        ],
    ];
      
    public function all(): array
    {
        return $this->productos;
    }
}
