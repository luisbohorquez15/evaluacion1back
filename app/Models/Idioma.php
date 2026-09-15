<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Idioma extends Model
{
    protected $table = 'idiomas';
    protected $fillable = ['nombre', 'codigo'];

    // Relación Eloquent: Un idioma tiene muchos Juegos
    public function juegos(): HasMany
    {
        return $this->hasMany(Juego::class, 'idioma_id');
    }

    // Relación Eloquent: Un idioma tiene muchas Expansiones
    public function expansiones(): HasMany
    {
        return $this->hasMany(Expansion::class, 'idioma_id');
    }
}