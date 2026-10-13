<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Plato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Registrar Nuevo Plato</h2>

    @if(session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif

    <form action="{{ route('platos.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del plato</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
            @error('nombre') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio ($)</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="{{ old('precio') }}">
            @error('precio') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
            @error('descripcion') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del plato</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
            @error('imagen') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('platos.index') }}" class="btn btn-secondary">Volver al listado</a>
            <button type="submit" class="btn btn-primary">Guardar Plato</button>
        </div>
    </form>
</body>
</html>