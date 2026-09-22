<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdVault - Catálogo Principal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para Íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .badge-promo {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
        .card-img-top-placeholder {
            height: 200px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar / Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                <i class="fa-solid fa-mask me-2"></i>NerdVault
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('welcome') }}">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <!-- Enlace al Gestor CRUD de Productos -->
                        <a class="nav-link" href="{{ route('productos.index') }}">Gestión de Productos</a>
                    </li>
                </ul>
                <a href="{{ route('carrito.index') }}" class="btn btn-outline-light position-relative">
                    <i class="fa-solid fa-cart-shopping me-1"></i> Carrito
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <div class="container">

        <!-- Mensajes de Estado (Éxito / Error) -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Banner Principal -->
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-8 px-0">
                <h1 class="display-5 fw-bold">Bienvenido a NerdVault</h1>
                <p class="lead my-3">Tu tienda geek favorita. Encuentra ropa, accesorios, cómics y figuras de colección de tus franquicias preferidas.</p>
            </div>
        </div>

        <!-- Filtros de Búsqueda -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('welcome') }}" method="GET" class="row g-3 align-items-end">
                    
                    <!-- Búsqueda por Nombre -->
                    <div class="col-md-4">
                        <label for="buscar" class="form-label fw-bold">Buscar por nombre</label>
                        <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Ej. Zelda, Batman..." value="{{ request('buscar') }}">
                    </div>

                    <!-- Filtro por Categoría -->
                    <div class="col-md-3">
                        <label for="categoria_id" class="form-label fw-bold">Categoría</label>
                        <select name="categoria_id" id="categoria_id" class="form-select">
                            <option value="">Todas las Categorías</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Franquicia -->
                    <div class="col-md-3">
                        <label for="franquicia" class="form-label fw-bold">Franquicia</label>
                        <select name="franquicia" id="franquicia" class="form-select">
                            <option value="">Todas las Franquicias</option>
                            @foreach($franquicias as $franquicia)
                                <option value="{{ $franquicia }}" {{ request('franquicia') == $franquicia ? 'selected' : '' }}>
                                    {{ $franquicia }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-filter"></i> Filtrar
                        </button>
                        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary" title="Limpiar Filtros">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de Productos -->
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
            @forelse($productos as $producto)
                @php
                    // Lógica del Descuento: Stock mayor a 20 unidades
                    $tieneDescuento = $producto->stock > 20;
                    $precioFinal = $tieneDescuento ? $producto->precio * 0.90 : $producto->precio;
                @endphp

                <div class="col">
                    <div class="card h-100 shadow-sm position-relative">
                        
                        <!-- Badge de Promoción / Stock -->
                        @if($producto->stock == 0)
                            <span class="badge bg-danger badge-promo">Agotado</span>
                        @elseif($tieneDescuento)
                            <span class="badge bg-warning text-dark badge-promo">
                                <i class="fa-solid fa-tag"></i> 10% OFF
                            </span>
                        @endif

                        <!-- Placeholder de Imagen -->
                        <div class="card-img-top-placeholder">
                            <i class="fa-solid fa-box-open fa-3x"></i>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <small class="text-muted text-uppercase fw-bold">{{ $producto->franquicia }}</small>
                            <h5 class="card-title mt-1">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($producto->descripcion, 70) }}
                            </p>

                            <!-- Indicador de Categoria -->
                            <div class="mb-2">
                                <span class="badge bg-secondary">{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</span>
                            </div>

                            <!-- Precios -->
                            <div class="mb-3">
                                @if($tieneDescuento)
                                    <span class="text-decoration-line-through text-muted me-2">${{ number_format($producto->precio, 2) }}</span>
                                    <span class="fs-5 fw-bold text-success">${{ number_format($precioFinal, 2) }}</span>
                                @else
                                    <span class="fs-5 fw-bold text-dark">${{ number_format($producto->precio, 2) }}</span>
                                @endif
                            </div>

                            <!-- Disponibilidad -->
                            <div class="mb-3 small">
                                @if($producto->stock > 0)
                                    <span class="text-success"><i class="fa-solid fa-check-circle"></i> Stock: {{ $producto->stock }} unids.</span>
                                @else
                                    <span class="text-danger"><i class="fa-solid fa-times-circle"></i> Sin Stock disponible</span>
                                @endif
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-outline-primary btn-sm">
                                    Ver Detalle
                                </a>
                                
                                @if($producto->stock > 0)
                                    <form action="{{ route('carrito.add', $producto->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            <i class="fa-solid fa-cart-plus"></i> Agregar al Carrito
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm w-100" disabled>
                                        No disponible
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-ghost fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No se encontraron productos</h4>
                    <p class="text-muted">Intenta cambiar los filtros de búsqueda.</p>
                </div>
            @endforelse
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} NerdVault - Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>