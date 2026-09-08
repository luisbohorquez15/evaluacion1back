@extends('layouts.app')

@section('content')
<h1>Crear idioma</h1>
<a href="{{ route('idiomas.index') }}">Volver a idiomas</a>

<form action="{{ route('idiomas.store') }}" method="POST">
    @csrf

    <div>
        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" type="text" maxlength="50" value="{{ old('nombre') }}" required>
        @error('nombre')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="codigo">Código</label>
        <input id="codigo" name="codigo" type="text" maxlength="5" value="{{ old('codigo') }}" required>
        @error('codigo')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Guardar idioma</button>
</form>
@endsection
