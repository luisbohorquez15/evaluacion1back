<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú del Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="text-center mb-4">Menú del Restaurante</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($platos as $plato)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $plato->nombre }}</h5>
                        <p class="card-text fw-bold text-success">${{ number_format($plato->precio, 2) }}</p>
                        <a href="{{ route('menu.show', $plato->id) }}" class="btn btn-outline-primary w-100">Ver Detalle</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center w-100">No hay platos disponibles en la carta por el momento.</p>
        @endforelse
    </div>
</body>
</html>