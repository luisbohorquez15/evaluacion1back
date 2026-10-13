<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'titulo', 'descripcion'])]
class Curso extends Model
{
    public function profesor() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}