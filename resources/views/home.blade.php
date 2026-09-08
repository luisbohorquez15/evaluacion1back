<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$app_name}} | Tu próxima gran lectura empieza aquí</title>
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
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .welcome-card {
            background-color: #ffffff;
            padding: 3rem 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }

        .welcome-card h2 {
            color: #1e3a8a;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .welcome-card p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff;
            padding: 0.8rem 1.8rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }

        footer {
            background-color: #e2e8f0;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            color: #64748b;
        }
    </style>
</head>
<body>

    <header>
        <h1>ULibro</h1>
    </header>

    <main>
        <section class="welcome-card">
            <h2>¡Bienvenido a ULibro!</h2>
            <p>
                Estamos preparando el rincón perfecto para los amantes de la lectura. 
                Descubre grandes historias y explora nuestro catálogo completo.
            </p>
            <a href="/productos" class="btn">Explorar Productos</a>
        </section>
    </main>