<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/js/app.js')  <!-- Para la compilación de Vite (si usas Breeze) -->
</head>
<body>
    <nav>
        <!-- Aquí puedes agregar tu barra de navegación -->
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a></li>
        </ul>
    </nav>

    <div>
        @yield('content')  <!-- Esto se reemplazará con el contenido de cada vista -->
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
