<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Juego
{
    public static function all()
    {
        return DB::table('juegos as j')
            ->join('idiomas as i', 'j.idioma_id', '=', 'i.id')
            ->select('j.id', 'j.titulo', 'j.anio', 'i.nombre as idioma')
            ->get();
    }

    public static function find($id)
    {
        return DB::table('juegos as j')
            ->join('idiomas as i', 'j.idioma_id', '=', 'i.id')
            ->select('j.id', 'j.titulo', 'j.anio', 'i.nombre as idioma', 'j.idioma_id')
            ->where('j.id', $id)
            ->first();
    }

    public static function create(array $datos)
    {
        return DB::table('juegos')->insert([
            'titulo'    => $datos['titulo'] ?? null,
            'anio'      => $datos['anio'] ?? null,
            'idioma_id' => $datos['idioma_id'] ?? null,
        ]);
    }

    public static function update($id, array $datos)
    {
        return DB::table('juegos')->where('id', $id)->update([
            'titulo'    => $datos['titulo'] ?? null,
            'anio'      => $datos['anio'] ?? null,
            'idioma_id' => $datos['idioma_id'] ?? null,
        ]);
    }

    public static function destroy($id)
    {
        return DB::table('juegos')->where('id', $id)->delete();
    }
}