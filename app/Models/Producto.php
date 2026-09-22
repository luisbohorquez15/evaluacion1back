<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'franquicia', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Calcula automáticamente el precio con descuento si stock > 20
    public function getPrecioFinalAttribute()
    {
        if ($this->stock > 20) {
            return $this->precio * 0.90;
        }
        return $this->precio;
    }

    // Propiedad para saber si aplica promoción
    public function getTieneDescuentoAttribute()
    {
        return $this->stock > 20;
    }
}