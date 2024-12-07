<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Home</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('admin.settings') }}">Configuración</a>
        <a href="{{ route('logout') }}" 
            onclick="event.preventDefault(); 
                     document.getElementById('logout-form').submit();">Cerrar Sesión</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    <div class="content">
        <h1>Bienvenido, Administrador</h1>
        <p>Esta es la vista de inicio para administradores.</p>
    </div>
</body>
</html>
