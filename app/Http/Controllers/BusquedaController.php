<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Idioma;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        $idiomas = Idioma::all();

        // Comprobar si el usuario envió al menos un filtro de búsqueda
        $hayFiltros = $request->filled('nombre') 
                   || $request->filled('anio_desde') 
                   || $request->filled('anio_hasta') 
                   || $request->filled('idioma_id');

        // Si no hay filtros aplicados (por ejemplo, al limpiar), devolver una colección vacía
        if (!$hayFiltros) {
            $juegos = collect();
            return view('busqueda.index', compact('juegos', 'idiomas'));
        }

        $query = Juego::with(['idioma', 'expansiones']);

        // Filtro 1: Búsqueda parcial por nombre en Juego O en sus Expansiones
        if ($request->filled('nombre')) {
            $nombre = $request->input('nombre');
            $query->where(function ($q) use ($nombre) {
                $q->where('titulo', 'LIKE', "%{$nombre}%")
                  ->orWhereHas('expansiones', function ($qExp) use ($nombre) {
                      $qExp->where('titulo', 'LIKE', "%{$nombre}%");
                  });
            });
        }

        // Filtro 2: Rango de años de creación
        if ($request->filled('anio_desde')) {
            $query->where('anio', '>=', $request->input('anio_desde'));
        }
        if ($request->filled('anio_hasta')) {
            $query->where('anio', '<=', $request->input('anio_hasta'));
        }

        // Filtro 3: Idioma seleccionado mediante desplegable
        if ($request->filled('idioma_id')) {
            $query->where('idioma_id', $request->input('idioma_id'));
        }

        $juegos = $query->get();

        return view('busqueda.index', compact('juegos', 'idiomas'));
    }
}