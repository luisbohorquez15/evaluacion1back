@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Encabezado Principal --}}
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                🔍 Búsqueda Avanzada
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Filtra el catálogo completo de juegos de mesa y sus expansiones asociadas.
            </p>
        </div>
    </div>

    {{-- Tarjeta del Formulario de Búsqueda --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mb-8 p-6">
        <form action="{{ route('busqueda.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                
                {{-- Filtro 1: Nombre del Juego o Expansión --}}
                <div class="md:col-span-2">
                    <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                        Título o Expansión
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="text" 
                               name="nombre" 
                               id="nombre" 
                               class="block w-full rounded-lg border-gray-300 pl-4 pr-4 py-2.5 text-gray-900 border focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all" 
                               value="{{ request('nombre') }}" 
                               placeholder="Ej: Catan, Mar, Expansión...">
                    </div>
                </div>

                {{-- Filtro 2: Rango de Años --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Rango de Años</label>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="number" 
                               name="anio_desde" 
                               class="block w-full rounded-lg border-gray-300 px-3 py-2.5 text-gray-900 border focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" 
                               value="{{ request('anio_desde') }}" 
                               placeholder="Desde">
                        <input type="number" 
                               name="anio_hasta" 
                               class="block w-full rounded-lg border-gray-300 px-3 py-2.5 text-gray-900 border focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" 
                               value="{{ request('anio_hasta') }}" 
                               placeholder="Hasta">
                    </div>
                </div>

                {{-- Filtro 3: Seleccionar Idioma --}}
                <div>
                    <label for="idioma_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Idioma
                    </label>
                    <select name="idioma_id" 
                            id="idioma_id" 
                            class="block w-full rounded-lg border-gray-300 px-3 py-2.5 text-gray-900 border focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
                        <option value="">Todos los idiomas</option>
                        @foreach($idiomas as $idioma)
                            <option value="{{ $idioma->id }}" {{ request('idioma_id') == $idioma->id ? 'selected' : '' }}>
                                {{ $idioma->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="mt-6 flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('busqueda.index') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Limpiar Filtros
                </a>
                <button type="submit" 
                        class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-sm transition-all flex items-center gap-2">
                    Aplicar Búsqueda
                </button>
            </div>
        </form>
    </div>

    {{-- Tabla de Resultados --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-gray-800">Resultados Encontrados</h3>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                {{ $juegos->count() }} {{ Str::plural('registro', $juegos->count()) }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Juego de Mesa</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Año</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Idioma Base</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Expansiones Incluidas</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($juegos as $juego)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            {{-- Título --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $juego->titulo }}</div>
                            </td>
                            
                            {{-- Año --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    {{ $juego->anio }}
                                </span>
                            </td>
                            
                            {{-- Idioma --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                @if($juego->idioma)
                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                        🌐 {{ $juego->idioma->nombre }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">Sin especificar</span>
                                @endif
                            </td>

                            {{-- Expansiones --}}
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if($juego->expansiones->count() > 0)
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($juego->expansiones as $exp)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-purple-50 text-purple-700 border border-purple-200">
                                                🧩 {{ $exp->nombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">Sin expansiones registradas</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <div class="max-w-xs mx-auto">
                                    <p class="text-base font-semibold text-gray-700">Sin coincidencias</p>
                                    <p class="text-xs text-gray-400 mt-1">Intenta ajustando los filtros de búsqueda para encontrar otros registros.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection