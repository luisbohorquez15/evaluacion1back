@extends('layouts.app')

@section('content')
<h1>Crear Juego</h1>
<a href="{{ route('juegos.index') }}">Volver al listado</a>

<form action="{{ route('juegos.store') }}" method="POST">
    @csrf

    <div>
        <label for="titulo">Título</label>
        <input id="titulo" name="titulo" type="text" maxlength="100" value="{{ old('titulo') }}" required>
        @error('titulo')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="anio">Año</label>
        <input id="anio" name="anio" type="number" value="{{ old('anio') }}" required>
        @error('anio')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="idioma_id">Idioma</label>
        <select id="idioma_id" name="idioma_id" required>
            <option value="">Selecciona un idioma</option>
            @foreach($idiomas as $idioma)
                <option value="{{ $idioma->id }}" @selected(old('idioma_id') == $idioma->id)>
                    {{ $idioma->nombre }}
                </option>
            @endforeach
        </select>
        @error('idioma_id')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Guardar juego</button>
</form>
@endsection
