<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            border-left: 6px solid #e62429;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        a.btn {
            background: #e62429;
            color: white !important;
            padding: 12px 25px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Hola {{ $user->name }}</h2>

        <p>Hemos recibido una solicitud para restablecer tu contraseña en <strong>Marvelpedia</strong>.</p>

        <p>Para continuar, haz clic en el siguiente botón:</p>

        <a class="btn" href="{{ $url }}">Restablecer contraseña</a>

        <p>Si tú no solicitaste este cambio, puedes ignorar este mensaje.</p>

        <p class="footer">Marvelpedia © {{ date('Y') }}</p>

    </div>

</body>

</html>
