<!-- resources/views/client/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente - Home</title>
    <style>
        /* Reset básico de estilos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        /* Estilo del navbar */
        .navbar {
            background-color: #509bc6;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-right: 20px;
        }

        .navbar .dropdown {
            position: relative;
            display: inline-block;
        }

        .navbar .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .navbar .dropdown:hover .dropdown-content {
            display: block;
        }

        .navbar .dropdown-content a {
            color: #333;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .navbar .dropdown-content a:hover {
            background-color: #f4f4f4;
        }

        /* Estilo del contenido */
        .content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #509bc6;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3b82f6;
        }

        .buttons {
    margin-top: 20px;
}

.buttons .btn {
    display: inline-block;
    background-color: #509bc6;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    margin: 5px;
}

.buttons .btn:hover {
    background-color: #40789c;
}
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('client.home') }}">Home</a>
        </div>
        <div class="navbar-right">
            <div class="dropdown">
                <a href="javascript:void(0)">Mi Cuenta</a>
                <div class="dropdown-content">
                    <a href="{{ route('settings.edit') }}">Configuración</a>
                    <a href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); 
                                 document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="content">
        <h1>Bienvenido, Cliente</h1>
        <p>Esta es la vista de inicio para clientes.</p>

        <div class="buttons">
            <a href="{{ route('client.orders.create') }}" class="btn">Hacer Pedido</a> <br>
            <a href="{{ route('client.orders.index') }}" class="btn">Ver Pedidos</a>
        </div>

        <button onclick="window.location.href='{{ route('settings.edit') }}'">Ir a Configuración</button>
    </div>
</body>
</html>
