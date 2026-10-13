<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // <-- Agregar esta importación

class EventoController extends Controller
{
    public function index()
    {
        return response()->json(Evento::with('user:id,name')->get(), 200);
    }

    public function update(Request $request, Evento $evento)
    {
        Gate::authorize('update', $evento); // <-- Cambiar esta línea

        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:100',
            'descripcion' => 'nullable|string',
            'cupo_maximo' => 'sometimes|integer|gt:0',
        ]);

        $evento->update($validated);

        return response()->json([
            'message' => 'Evento actualizado correctamente',
            'evento' => $evento
        ], 200);
    }
}