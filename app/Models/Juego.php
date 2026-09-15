<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Juego extends Model
{
    protected $table = 'juegos';
    protected $fillable = ['titulo', 'anio', 'idioma_id'];

    // Relación Eloquent: Un juego pertenece a un Idioma
    public function idioma(): BelongsTo
    {
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }

    // Relación Eloquent: Un juego tiene muchas Expansiones
    public function expansiones(): HasMany
    {
        return $this->hasMany(Expansion::class, 'juego_id');
    }
}