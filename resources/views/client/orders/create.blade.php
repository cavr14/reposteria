<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacer Pedido</title>
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
        <h1>Hacer un Pedido</h1>
        <form method="POST" action="{{ route('client.orders.store') }}">
            @csrf
            <!-- Aquí puedes agregar los campos para hacer el pedido -->
            <div class="form-group">
                <label for="producto">Producto</label>
                <input id="producto" type="text" name="producto" required>
            </div>
            
            <button type="submit">Realizar Pedido</button>
        </form>
    </div>
</body>
</html>
