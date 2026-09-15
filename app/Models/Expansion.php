<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expansion extends Model
{
    protected $table = 'expansiones';

    protected $fillable = ['titulo', 'juego_id', 'idioma_id'];

    // Relación Eloquent: Una expansión pertenece a un juego
    public function juego(): BelongsTo
    {
        return $this->belongsTo(Juego::class, 'juego_id');
    }

    // Relación Eloquent: Una expansión pertenece a un idioma
    public function idioma(): BelongsTo
    {
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }
}