<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Idioma
{
    public static function all()
    {
        return DB::table('idiomas')->get();
    }

    public static function find($id)
    {
        return DB::table('idiomas')->where('id', $id)->first();
    }

    public static function create(array $datos)
    {
        return DB::table('idiomas')->insert([
            'nombre' => $datos['nombre'] ?? null,
            'codigo' => $datos['codigo'] ?? null,
        ]);
    }

    public static function update($id, array $datos)
    {
        return DB::table('idiomas')->where('id', $id)->update([
            'nombre' => $datos['nombre'] ?? null,
            'codigo' => $datos['codigo'] ?? null,
        ]);
    }

    public static function destroy($id)
    {
        return DB::table('idiomas')->where('id', $id)->delete();
    }
}