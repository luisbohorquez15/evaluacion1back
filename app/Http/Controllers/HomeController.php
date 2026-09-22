<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('franquicia')) {
            $query->where('franquicia', $request->franquicia);
        }

        if ($request->filled('buscar')) {
            $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
        }

        $productos = $query->get();
        $categorias = Categoria::all();
        $franquicias = Producto::select('franquicia')->distinct()->whereNotNull('franquicia')->pluck('franquicia');

        return view('welcome', compact('productos', 'categorias', 'franquicias'));
    }
}