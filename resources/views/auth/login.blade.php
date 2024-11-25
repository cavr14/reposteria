<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login de Usuario</h2>
    <form method="POST" action="{{ url('login') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Contraseña</label>
        <input type="password" name="password" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
