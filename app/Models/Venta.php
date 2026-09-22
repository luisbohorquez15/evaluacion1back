<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['cliente_nombre', 'cliente_email', 'tarjeta_numero', 'total'];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}