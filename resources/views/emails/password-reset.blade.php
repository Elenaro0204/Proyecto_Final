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
            text-align: center;
            font-size: 13px;
            color: #777;
        }

        .signature {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 13px;
            color: #555;
            text-align: left;
            line-height: 1.5;
        }

        .signature strong {
            color: #222;
        }

        .signature .role {
            color: #d32f2f;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Hola <strong>{{ $user->name }}</strong>, </h2>

        <p>Hemos recibido una solicitud para restablecer tu contraseña en <strong>Marvelpedia</strong>.</p>

        <p>Para continuar, haz clic en el siguiente botón:</p>

        <center>
            <a class="btn" href="{{ $url }}">Restablecer contraseña</a>
        </center>

        <p>Si tú no solicitaste este cambio, puedes ignorar este mensaje.</p>

        <footer class="footer">
            <p>
                © {{ date('Y') }} Marvelpedia - Todos los derechos reservados
            </p>
            <!-- Firma -->
            <table
                style="width:100%; border-top:1px solid #ddd; margin-top:25px; padding-top:15px; font-family:Arial, sans-serif;">
                <tr>
                    <td style="vertical-align:top; width:70px; padding-right:15px;">
                        <!-- Logo (cámbialo por tu URL real) -->
                        <img src="https://marvelpedia.ruix.iesruizgijon.es/logos/Icono.PNG" alt="Marvelpedia"
                            style="width:70px; height:auto; border-radius:6px;">
                    </td>

                    <td style="vertical-align:top; color:#333; font-size:14px; line-height:1.5;">
                        <strong style="font-size:16px; color:#d32f2f;">Soporte Marvelpedia</strong><br>
                        <span style="color:#555;">Equipo de revisión y moderación</span><br>

                        ✉️ <a href="mailto:soportemarvelpedia@gmail.com" style="color:#1976d2; text-decoration:none;">
                            soportemarvelpedia@gmail.com
                        </a><br>

                        🌐 <a href="https://marvelpedia.ruix.iesruizgijon.es"
                            style="color:#1976d2; text-decoration:none;">
                            marvelpedia.ruix.iesruizgijon.es
                        </a><br>

                        🕒 <span style="color:#555;">Respuesta estimada: 24–48h</span>
                    </td>
                </tr>
            </table>
        </footer>
    </div>
</body>

</html>
