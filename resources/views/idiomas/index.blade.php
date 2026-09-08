@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Header de la tarjeta -->
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Idiomas</h1>
            <p class="text-sm text-slate-500">Gestión de idiomas disponibles en la ludoteca.</p>
        </div>
        <a href="{{ route('idiomas.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-plus"></i> Nuevo Idioma
        </a>
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-100 text-xs text-slate-500 uppercase tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 font-semibold">ID</th>
                    <th class="px-6 py-4 font-semibold">Nombre</th>
                    <th class="px-6 py-4 font-semibold">Código</th>
                    <th class="px-6 py-4 font-semibold text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($idiomas as $idioma)
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="px-6 py-4 font-medium text-slate-900">#{{ $idioma->id }}</td>
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $idioma->nombre }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-slate-200 text-slate-700 font-mono text-xs px-2.5 py-1 rounded-md uppercase border border-slate-300">
                            {{ $idioma->codigo }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('idiomas.show', $idioma->id) }}" class="text-slate-500 hover:text-indigo-600 p-2 rounded-lg hover:bg-slate-100 transition" title="Ver detalle">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form action="{{ route('idiomas.destroy', $idioma->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este idioma?')">
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
                    <td colspan="4" class="px-6 py-8 text-center text-slate-400">
                        No hay idiomas registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection