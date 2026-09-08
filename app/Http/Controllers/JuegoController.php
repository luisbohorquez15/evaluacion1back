<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Idioma;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    public function index()
    {
        $juegos = Juego::all();
        return view('juegos.index', compact('juegos'));
    }

    public function show($id)
    {
        $juego = Juego::find($id);
        if (!$juego) abort(404, 'Juego no encontrado');
        return view('juegos.show', compact('juego'));
    }

    public function create()
    {
        $idiomas = Idioma::all();
        return view('juegos.create', compact('idiomas'));
    }

    public function store(Request $request)
    {
        Juego::create($request->only(['titulo', 'anio', 'idioma_id']));
        return redirect()->route('juegos.index')->with('success', 'Juego registrado correctamente.');
    }

    public function destroy($id)
    {
        Juego::destroy($id);
        return redirect()->route('juegos.index')->with('success', 'Juego eliminado correctamente.');
    }
}

