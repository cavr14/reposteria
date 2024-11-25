<!-- resources/views/auth/admin-login.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
</head>
<body>
    <h2>Login de Administrador</h2>
    <form method="POST" action="{{ url('admin/login') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Contraseña</label>
        <input type="password" name="password" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
