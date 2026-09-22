<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout - NerdVault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container col-md-8">
        <h2 class="mb-4">Finalizar Compra</h2>

        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <div class="row">
            <div class="col-md-6">
                <h4>Resumen del Pedido</h4>
                <ul class="list-group mb-3">
                    @foreach($carrito as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="my-0">{{ $item['nombre'] }}</h6>
                                <small class="text-muted">Cantidad: {{ $item['cantidad'] }}</small>
                            </div>
                            <span class="text-muted">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between fw-bold bg-light">
                        <span>Total a Pagar</span>
                        <span class="text-success">${{ number_format($total, 2) }}</span>
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <h4>Datos del Comprador y Pago</h4>
                <form action="{{ route('checkout.process') }}" method="POST" class="card card-body shadow-sm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="cliente_nombre" class="form-control" required placeholder="Ej. Juan Pérez">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="cliente_email" class="form-control" required placeholder="ejemplo@correo.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Número de Tarjeta de Crédito (16 dígitos)</label>
                        <input type="text" name="tarjeta_numero" class="form-control" placeholder="1234567812345678" maxlength="16" minlength="16" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-2">Pagar ${{ number_format($total, 2) }}</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>