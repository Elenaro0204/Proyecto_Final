<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #e62429;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>¡Bienvenido a Marvelpedia, {{ $user->name }}!</h2>
        <p>Para completar tu registro, haz clic en el botón de abajo y verifica tu correo:</p>
        <a class="button" href="{{ $verificationUrl }}">Verificar mi correo</a>
        <p>Si no creaste esta cuenta, ignora este correo.</p>
        <div class="footer">© 2025 Marvelpedia - Todos los derechos reservados</div>
    </div>
</body>

</html>
