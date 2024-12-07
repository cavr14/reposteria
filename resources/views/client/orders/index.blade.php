<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pedidos</title>
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
        <h1>Mis Pedidos</h1>
        <ul>
            <!-- Aquí puedes listar los pedidos del cliente -->
            <li>Pedido #1: Producto X</li>
            <li>Pedido #2: Producto Y</li>
        </ul>
    </div>
</body>
</html>
