@extends('layouts.app')

@section('content')
<h1>Crear Expansión</h1>
<a href="{{ route('expansiones.index') }}">Volver al listado</a>

<form action="{{ route('expansiones.store') }}" method="POST">
    @csrf

    <div>
        <label for="juego_id">Juego base</label>
        <select id="juego_id" name="juego_id" required>
            <option value="">Selecciona un juego</option>
            @foreach($juegos as $juego)
                <option value="{{ $juego->id }}" @selected(old('juego_id') == $juego->id)>
                    {{ $juego->titulo }}
                </option>
            @endforeach
        </select>
        @error('juego_id')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="titulo">Título</label>
        <input id="titulo" name="titulo" type="text" maxlength="100" value="{{ old('titulo') }}" required>
        @error('titulo')
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

    <button type="submit">Guardar expansión</button>
</form>
@endsection
