<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ludoteca</title>
    <!-- Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Encabezado y Navegación Principal -->
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-6 py-3 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <!-- Logo / Marca del Sistema -->
            <a href="/" class="text-xl font-extrabold tracking-wide flex items-center gap-3 hover:opacity-95 transition">
                <div class="bg-white text-indigo-600 p-2 rounded-lg shadow-sm">
                    <i class="fa-solid fa-dice-d6 text-xl"></i>
                </div>
                <span>Ludoteca<span class="text-indigo-200 font-light">App</span></span>
            </a>

            <!-- Menú de 3 Botones -->
            <div class="flex items-center gap-2">
                <a href="{{ route('idiomas.index') }}" 
                   class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('idiomas.*') ? 'bg-indigo-800 shadow-inner text-white' : 'hover:bg-indigo-700/80 text-indigo-100' }}">
                    <i class="fa-solid fa-language"></i> Idiomas
                </a>
                
                <a href="{{ route('juegos.index') }}" 
                   class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('juegos.*') ? 'bg-indigo-800 shadow-inner text-white' : 'hover:bg-indigo-700/80 text-indigo-100' }}">
                    <i class="fa-solid fa-dice"></i> Juegos
                </a>
                
                <a href="{{ route('expansiones.index') }}" 
                   class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('expansiones.*') ? 'bg-indigo-800 shadow-inner text-white' : 'hover:bg-indigo-700/80 text-indigo-100' }}">
                    <i class="fa-solid fa-puzzle-piece"></i> Expansiones
                </a>
            </div>

        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="max-w-6xl w-full mx-auto p-6 flex-grow">
        
        <!-- Alerta de éxito global -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-100 border border-emerald-300 text-emerald-800 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>