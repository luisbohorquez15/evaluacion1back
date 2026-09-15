<?php

namespace App\Http\Controllers;

use App\Models\Expansion;
use App\Models\Juego;
use App\Models\Idioma;
use Illuminate\Http\Request;

class ExpansionController extends Controller
{
    public function index()
    {
        // Carga ansiosa (eager loading) de juego e idioma para optimizar consultas
        $expansiones = Expansion::with(['juego', 'idioma'])->get();
        return view('expansiones.index', compact('expansiones'));
    }

    public function create()
    {
        $juegos = Juego::all();
        $idiomas = Idioma::all();
        return view('expansiones.create', compact('juegos', 'idiomas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'juego_id' => 'required|exists:juegos,id',
            'idioma_id' => 'required|exists:idiomas,id',
        ]);

        Expansion::create($request->only(['titulo', 'juego_id', 'idioma_id']));

        return redirect()->route('expansiones.index')->with('success', 'Expansión creada correctamente');
    }

    public function show(Expansion $expansion)
    {
        $expansion->load(['juego', 'idioma']);
        return view('expansiones.show', compact('expansion'));
    }

    public function update(Request $request, Expansion $expansion)
    {
        $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'juego_id' => 'sometimes|required|exists:juegos,id',
            'idioma_id' => 'sometimes|required|exists:idiomas,id',
        ]);

        $expansion->update($request->only(['titulo', 'juego_id', 'idioma_id']));
        return response()->json(['message' => 'Expansión actualizada', 'data' => $expansion]);
    }

    public function destroy(Expansion $expansion)
    {
        $expansion->delete();
        return response()->json(['message' => 'Expansión eliminada']);
    }
}