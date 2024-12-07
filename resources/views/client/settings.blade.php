<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente - Configuración</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('client.home') }}">Home</a>
        <a href="{{ route('logout') }}" 
            onclick="event.preventDefault(); 
                     document.getElementById('logout-form').submit();">Cerrar Sesión</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    <div class="content">
        <h1>Configuración del Cliente</h1>
        <p>Aquí puedes configurar los ajustes de tu cuenta.</p>
        <form method="POST" action="{{ route('client.settings.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input id="name" type="text" name="name" value="{{ auth()->user()->name }}" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input id="telefono" type="text" name="telefono" value="{{ auth()->user()->telefono }}">
            </div>

            <div class="form-group">
                <label for="domicilio">Domicilio</label>
                <input id="domicilio" type="text" name="domicilio" value="{{ auth()->user()->domicilio }}">
            </div>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
