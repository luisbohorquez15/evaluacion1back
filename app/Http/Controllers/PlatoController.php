<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use App\Http\Requests\PlatoRequest;
use App\Http\Requests\UpdatePlatoRequest;
use Illuminate\Support\Facades\Storage;

class PlatoController extends Controller
{
    // Listado de administración (/platos)
    public function index()
    {
        $platos = Plato::all();
        return view('platos.index', compact('platos'));
    }

    // Formulario de creación (/platos/crear)
    public function create()
    {
        return view('platos.create');
    }

    // Guardar nuevo plato
    public function store(PlatoRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            // Guardar en la estructura storage/app/public/platos/AAAA/MM
            $rutaCarpeta = 'platos/' . date('Y/m');
            $data['imagen'] = $request->file('imagen')->store($rutaCarpeta, 'public');
        }

        Plato::create($data);

        return redirect()->route('platos.create')->with('exito', 'Plato creado con éxito.');
    }

    // Formulario de edición (/platos/{id}/editar)
    public function edit($id)
    {
        $plato = Plato::findOrFail($id);
        return view('platos.edit', compact('plato'));
    }

    // Actualizar plato
    public function update(UpdatePlatoRequest $request, $id)
    {
        $plato = Plato::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            // Eliminar imagen vieja del servidor si existe
            if ($plato->imagen && Storage::disk('public')->exists($plato->imagen)) {
                Storage::disk('public')->delete($plato->imagen);
            }

            // Subir nueva imagen
            $rutaCarpeta = 'platos/' . date('Y/m');
            $data['imagen'] = $request->file('imagen')->store($rutaCarpeta, 'public');
        }

        $plato->update($data);

        return redirect()->route('platos.index')->with('exito', 'Plato actualizado correctamente.');
    }

    // Soft Delete (/platos/{id})
    public function destroy($id)
    {
        $plato = Plato::findOrFail($id);
        $plato->delete();

        return redirect()->route('platos.index')->with('exito', 'Plato eliminado.');
    }

    // Vista pública: Carta (/menu)
    public function menu()
    {
        $platos = Plato::orderBy('nombre', 'asc')->get();
        return view('menu.index', compact('platos'));
    }

    // Vista pública: Detalle (/menu/{id})
    public function menuDetalle($id)
    {
        $plato = Plato::findOrFail($id);
        return view('menu.show', compact('plato'));
    }
}