<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Platos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Administración de Platos</h2>
        <a href="{{ route('platos.create') }}" class="btn btn-success">+ Registrar Nuevo Plato</a>
    </div>

    @if(session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($platos as $plato)
                <tr>
                    <td>{{ $plato->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $plato->imagen) }}" alt="{{ $plato->nombre }}" width="80" height="60" style="object-fit: cover;" class="rounded">
                    </td>
                    <td>{{ $plato->nombre }}</td>
                    <td>${{ number_format($plato->precio, 2) }}</td>
                    <td>
                        <a href="{{ route('platos.edit', $plato->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('platos.destroy', $plato->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este plato?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay platos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>