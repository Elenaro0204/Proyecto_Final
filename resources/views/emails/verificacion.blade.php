<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .header {
            background-color: #e62429;
            color: #fff;
            text-align: center;
            padding: 25px 15px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .content {
            padding: 25px 30px;
            color: #333;
            line-height: 1.6;
        }

        h2 {
            margin-top: 0;
            color: #e62429;
            font-size: 22px;
        }

        .button {
            display: inline-block;
            background-color: #e62429;
            color: #ffffff !important;
            padding: 12px 22px;
            margin: 18px 0;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .footer {
            background-color: #fafafa;
            padding: 20px 25px;
            font-size: 13px;
            color: #777;
            border-top: 1px solid #e0e0e0;
        }

        .footer a {
            color: #1976d2;
            text-decoration: none;
        }

        .signature-table {
            width: 100%;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .signature-table td {
            vertical-align: top;
        }

        .signature-logo {
            width: 70px;
            border-radius: 6px;
        }

    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            ¡Bienvenido a Marvelpedia!
        </div>

        <div class="content">
            <h2>Hola, {{ $user->name }} 👋</h2>

            <p>
                ¡Gracias por unirte a <strong>Marvelpedia</strong>! Antes de comenzar a explorar héroes, villanos y todo
                el universo cinematográfico y de cómics, necesitamos que verifiques tu correo electrónico.
            </p>

            <a class="button" href="{{ $verificationUrl }}">Verificar mi correo</a>

            <p>
                Si no has creado esta cuenta, puedes ignorar este mensaje sin problema.
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Marvelpedia — Todos los derechos reservados.</p>

            <table class="signature-table">
                <tr>
                    <td style="width: 70px;">
                        <img src="https://marvelpedia.ruix.iesruizgijon.es/logo.png"
                             alt="Marvelpedia" class="signature-logo">
                    </td>

                    <td>
                        <strong style="color:#e62429; font-size:15px;">Soporte Marvelpedia</strong><br>
                        <span style="color:#555;">Equipo de asistencia y moderación</span><br><br>

                        ✉️ <a href="mailto:soportemarvelpedia@gmail.com">
                            soportemarvelpedia@gmail.com
                        </a><br>

                        🌐 <a href="https://marvelpedia.ruix.iesruizgijon.es">
                            marvelpedia.ruix.iesruizgijon.es
                        </a><br>

                        🕒 Tiempo de respuesta: 24–48h
                    </td>
                </tr>
            </table>
        </div>

    </div>

</body>
</html>
