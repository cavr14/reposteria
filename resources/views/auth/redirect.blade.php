<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Creada</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .navbar {
            width: 100%;
            background-color: #333;
            padding: 1rem;
            display: flex;
            justify-content: center;
        }
        .navbar a {
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            font-size: 1.2rem;
        }
        .content {
            text-align: center;
            margin-top: 2rem;
        }
        .content h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('login') }}" class="btn">Iniciar sesión</a>
    </div>
    <div class="content">
        <h1>Cuenta Creada Exitosamente</h1>
        <p>Su cuenta ha sido creada exitosamente. Ahora puede iniciar sesión.</p>
    </div>
</body>
</html>
