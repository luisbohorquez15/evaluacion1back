<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle: {{ $plato->nombre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="card mx-auto shadow-sm" style="max-width: 600px;">
        <img src="{{ asset('storage/' . $plato->imagen) }}" class="card-img-top" alt="{{ $plato->nombre }}" style="max-height: 350px; object-fit: cover;">
        <div class="card-body">
            <h2 class="card-title">{{ $plato->nombre }}</h2>
            <h4 class="text-success my-3">${{ number_format($plato->precio, 2) }}</h4>
            <p class="card-text">{{ $plato->descripcion }}</p>
            <hr>
            <a href="{{ route('menu.index') }}" class="btn btn-secondary">← Volver al Menú</a>
        </div>
    </div>
</body>
</html>