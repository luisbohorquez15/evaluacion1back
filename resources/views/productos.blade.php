<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULibro | Catálogo de Productos</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #1e3a8a;
            color: #ffffff;
            padding: 1.5rem 2rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        header h1 {
            font-size: 2.5rem;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        nav a {
            color: #dbeafe;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        nav a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        main {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
        }

        .page-title {
            text-align: center;
            color: #1e3a8a;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        /* Grid de Productos */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        /* Tarjeta de Producto */
        .product-card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background-color: #e2e8f0;
        }

        .product-info {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .product-title {
            font-size: 1.25rem;
            color: #1e3a8a;
            margin-bottom: 0.5rem;
        }

        .product-description {
            font-size: 0.95rem;
            color: #555;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            flex: 1; /* Empuja el precio y botón al final */
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #059669;
        }

        .btn-buy {
            background-color: #2563eb;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.2s ease;
        }

        .btn-buy:hover {
            background-color: #1d4ed8;
        }

        /* Mensaje cuando no hay productos */
        .empty-state {
            text-align: center;
            padding: 3rem;
            background-color: #ffffff;
            border-radius: 12px;
            color: #64748b;
        }

        footer {
            background-color: #e2e8f0;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            color: #64748b;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <header>
        <h1>ULibro</h1>
        <nav>
            <a href="/">← Volver al Inicio</a>
        </nav>
    </header>

    <main>
        <h2 class="page-title">Catálogo de Libros</h2>

        {{-- Recorremos la lista de productos enviada desde el controlador --}}
        @forelse ($productos as $producto)
            @if ($loop->first)
                <div class="products-grid">
            @endif

            <article class="product-card">
                <img 
                    src="{{ $producto['imagen'] }}" 
                    alt="{{ $producto['nombre'] }}" 
                    class="product-image"
                >
                <div class="product-info">
                    <h3 class="product-title">{{ $producto['nombre'] }}</h3>
                    <p class="product-description">{{ $producto['descripcion'] }}</p>
                    
                    <div class="product-footer">
                        {{-- Formateamos el precio como moneda local --}}
                        <span class="product-price">${{ number_format($producto['precio'], 0, ',', '.') }}</span>
                        <a href="/productos/{{ $producto['id'] }}" class="btn-buy">Ver Detalle</a>
                    </div>
                </div>
            </article>

            @if ($loop->last)
                </div>
            @endif
        @empty
            <div class="empty-state">
                <p>No hay productos disponibles en este momento.</p>
            </div>
        @endforelse
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} ULibro. Todos los derechos reservados.</p>
    </footer>

</body>
</html>