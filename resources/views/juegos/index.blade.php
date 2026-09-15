@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Juegos de Mesa</h1>
            <p class="text-sm text-slate-500">Listado de títulos principales registrados en la ludoteca.</p>
        </div>
        <a href="{{ route('juegos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-plus"></i> Nuevo Juego
        </a>
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-100 text-xs text-slate-500 uppercase tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 font-semibold">ID</th>
                    <th class="px-6 py-4 font-semibold">Título</th>
                    <th class="px-6 py-4 font-semibold">Año</th>
                    <th class="px-6 py-4 font-semibold">Idioma</th>
                    <th class="px-6 py-4 font-semibold text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($juegos as $juego)
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="px-6 py-4 font-medium text-slate-900">#{{ $juego->id }}</td>
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $juego->titulo }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-slate-100 text-slate-600 font-medium px-2.5 py-1 rounded-md border border-slate-200 text-xs">
                            <i class="fa-regular fa-calendar mr-1"></i>{{ $juego->anio }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-indigo-50 text-indigo-700 font-medium px-2.5 py-1 rounded-md text-xs border border-indigo-100">
                            <i class="fa-solid fa-language mr-1"></i>{{ $juego->idioma->nombre }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('juegos.show', $juego->id) }}" class="text-slate-500 hover:text-indigo-600 p-2 rounded-lg hover:bg-slate-100 transition" title="Ver detalle">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form action="{{ route('juegos.destroy', $juego->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este juego?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-500 hover:text-rose-600 p-2 rounded-lg hover:bg-slate-100 transition" title="Eliminar">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                        No hay juegos registrados en el catálogo.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection