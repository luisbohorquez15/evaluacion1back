@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Expansiones</h1>
            <p class="text-sm text-slate-500">Módulos y contenido adicional para juegos base.</p>
        </div>
        <a href="{{ route('expansiones.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-plus"></i> Nueva Expansión
        </a>
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-100 text-xs text-slate-500 uppercase tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 font-semibold">ID</th>
                    <th class="px-6 py-4 font-semibold">Título Expansión</th>
                    <th class="px-6 py-4 font-semibold">Juego Base</th>
                    <th class="px-6 py-4 font-semibold">Idioma</th>
                    <th class="px-6 py-4 font-semibold text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($expansiones as $exp)
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="px-6 py-4 font-medium text-slate-900">#{{ $exp->id }}</td>
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $exp->titulo }}</td>
                    <td class="px-6 py-4 font-medium text-slate-600">
                        <span class="bg-slate-100 text-slate-700 px-2.5 py-1 rounded-md border border-slate-200 text-xs">
                            <i class="fa-solid fa-box-archive mr-1 text-slate-400"></i>{{ $exp->juego_base }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-indigo-50 text-indigo-700 font-medium px-2.5 py-1 rounded-md text-xs border border-indigo-100">
                            {{ $exp->idioma }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('expansiones.show', $exp->id) }}" class="text-slate-500 hover:text-indigo-600 p-2 rounded-lg hover:bg-slate-100 transition" title="Ver detalle">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form action="{{ route('expansiones.destroy', $exp->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta expansión?')">
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
                        No hay expansiones registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection