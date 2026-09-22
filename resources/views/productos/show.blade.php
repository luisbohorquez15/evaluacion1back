<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $producto->nombre }} - NerdVault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container col-md-8">
        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary mb-3">← Volver al Catálogo</a>
        <div class="card shadow-sm">
            <div class="card-body">
                <h2>{{ $producto->nombre }}</h2>
                <div class="mb-3">
                    <span class="badge bg-info text-dark">{{ $producto->franquicia }}</span>
                    <span class="badge bg-secondary">{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</span>
                </div>

                <p class="mt-3 lead">{{ $producto->descripcion }}</p>

                <div class="my-4">
                    @if($producto->tiene_descuento)
                        <span class="text-decoration-line-through text-muted fs-5">${{ number_format($producto->precio, 2) }}</span>
                        <h3 class="text-success fw-bold">${{ number_format($producto->precio_final, 2) }} <span class="badge bg-warning text-dark fs-6">10% OFF</span></h3>
                    @else
                        <h3 class="fw-bold">${{ number_format($producto->precio, 2) }}</h3>
                    @endif
                </div>

                <p>Stock disponible: <strong>{{ $producto->stock }} unidades</strong></p>

                @if($producto->stock > 0)
                    <form action="{{ route('carrito.add', $producto->id) }}" method="POST" class="row g-3 align-items-center mt-2">
                        @csrf
                        <div class="col-auto">
                            <label for="cantidad" class="col-form-label fw-bold">Cantidad a comprar:</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" max="{{ $producto->stock }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">Agregar al Carrito</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-danger mt-3">Este producto está agotado.</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>