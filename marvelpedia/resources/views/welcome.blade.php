<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Marvelpedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 text-center">
        <h1 class="display-4">¡Bienvenido a Marvelpedia!</h1>
        <p class="lead">Tu enciclopedia de personajes Marvel favorita.</p>

        <!-- Botones -->
        <a href="{{ route('login') }}" class="btn btn-primary mt-3">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="btn btn-success mt-3">Registrarse</a>
    </div>
</body>
</html>
