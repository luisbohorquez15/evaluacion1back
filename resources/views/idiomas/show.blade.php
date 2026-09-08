@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
        <h1 class="text-xl font-bold text-slate-800">Detalle del Idioma</h1>
        <span class="text-xs bg-indigo-100 text-indigo-700 font-bold px-3 py-1 rounded-full">ID: #{{ $idioma->id }}</span>
    </div>
    
    <div class="p-6 space-y-4">
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Nombre</label>
            <p class="text-lg font-medium text-slate-800">{{ $idioma->nombre }}</p>
        </div>
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Código ISO</label>
            <p class="mt-1">
                <span class="inline-block bg-slate-100 text-slate-700 font-mono text-sm px-3 py-1 rounded-md border border-slate-200">
                    {{ $idioma->codigo }}
                </span>
            </p>
        </div>
    </div>

    <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end">
        <a href="{{ route('idiomas.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium text-sm rounded-lg transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Volver al listado
        </a>
    </div>
</div>
@endsection