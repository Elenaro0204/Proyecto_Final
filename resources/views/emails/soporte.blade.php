<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mensaje desde Marvelpedia</title>
</head>

<body>
    <div class="container">
        <h2>Marvelpedia - Nuevo mensaje de soporte</h2>

        <div class="info">
            <p><span class="label">Nombre:</span> {{ $nombre }}</p>
            <p><span class="label">Email:</span> {{ $email }}</p>
        </div>

        <div class="mensaje">
            <p>{{ $mensaje }}</p>
        </div>

        <footer>
            © 2025 Marvelpedia - Todos los derechos reservados
        </footer>
    </div>
</body>

</html>
