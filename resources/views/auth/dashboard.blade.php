<!-- resources/views/auth/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin: 0;
        }

        h2 {
            margin: 20px;
            font-size: 24px;
            color: #333;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        select {
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            display: inline-block;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>Dashboard del Administrador</h1>

    <div class="container">
        <h2>Pedidos Pendientes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Teléfono</th>
                    <th>Producto</th>
                    <th>Sabor</th>
                    <th>Tamaño / Cantidad</th>
                    <th>Relleno</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->cliente_id }}</td>
                        <td>{{ $pedido->telefono }}</td>
                        <td>{{ $pedido->producto }}</td>
                        <td>{{ $pedido->sabor }}</td>
                        <td>{{ $pedido->tamano_cantidad }}</td>
                        <td>{{ $pedido->relleno }}</td>
                        <td>{{ $pedido->status }}</td>
                        <td>
                            <form action="{{ route('admin.update-status', $pedido->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status">
                                    <option value="pendiente" {{ $pedido->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="en_proceso" {{ $pedido->status == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                    <option value="finalizado" {{ $pedido->status == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                </select>
                                <button type="submit">Actualizar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
