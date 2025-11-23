<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenido a Marvelpedia!</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', Arial, sans-serif;
            color: #ffffff;
        }

        .wrapper {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #121212;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            border-top: 8px solid #e62429;
        }

        .header {
            background: linear-gradient(90deg, #e62429, #ff3d3d);
            padding: 20px;
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #fff;
        }

        .header span {
            color: #ffd700;
        }

        .content {
            padding: 25px;
        }

        h2 {
            color: #e62429;
            font-size: 22px;
            margin-top: 0;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #cccccc;
        }

        .button {
            display: block;
            text-align: center;
            width: 80%;
            max-width: 300px;
            margin: 25px auto;
            padding: 15px 0;
            background: linear-gradient(90deg, #e62429, #ff3d3d);
            color: #fff !important;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        .button:hover {
            background: linear-gradient(90deg, #ff3d3d, #e62429);
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888;
            background-color: #1a1a1a;
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                border-radius: 0;
            }

            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                ¡Bienvenido a <span>Marvelpedia</span>!
            </div>

            <div class="content">
                <h2>Hola, {{ $user->name }}!</h2>
                <p>¡Gracias por registrarte en <strong>Marvelpedia</strong>! Antes de empezar a explorar nuestros
                    personajes, cómics y películas, necesitamos que verifiques tu correo electrónico.</p>

                <a href="{{ $verificationUrl }}" class="button">Verificar mi correo</a>

                <p>Si no te registraste en <strong>Marvelpedia</strong>, puedes ignorar este correo sin problemas.</p>
            </div>

            <div class="footer">
                © 2025 Marvelpedia. Todos los derechos reservados.
            </div>
        </div>
    </div>
</body>

</html>
