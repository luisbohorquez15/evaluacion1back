<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras - NerdVault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container">
        <h1 class="mb-4">Carrito de Compras</h1>
        
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        @if(empty($carrito))
            <div class="alert alert-info">Tu carrito de compras está vacío.</div>
            <a href="{{ route('welcome') }}" class="btn btn-primary">Ir al Catálogo</a>
        @else
            <table class="table table-bordered bg-white align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carrito as $id => $item)
                        @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
                        <tr>
                            <td>
                                <strong>{{ $item['nombre'] }}</strong><br>
                                <small class="text-muted">{{ $item['franquicia'] }}</small>
                            </td>
                            <td>${{ number_format($item['precio'], 2) }}</td>
                            <td>
                                <form action="{{ route('carrito.update', $id) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="form-control w-50">
                                    <button class="btn btn-sm btn-outline-primary">Actualizar</button>
                                </form>
                            </td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <form action="{{ route('carrito.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Quitar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <h4>Total: <span class="text-success fw-bold">${{ number_format($total, 2) }}</span></h4>
                <div>
                    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">Seguir Comprando</a>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success">Procesar Checkout</a>
                </div>
            </div>
        @endif
    </div>
</body>
</html>