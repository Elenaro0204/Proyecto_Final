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
        <div class="header">
            ¡Bienvenido a <span>Marvelpedia</span>!
        </div>

        <div class="content">
            <h2>Hola, {{ $user->name }}!</h2>
            <p>¡Gracias por registrarte en <strong>Marvelpedia</strong>! Antes de empezar a explorar nuestros
                personajes, cómics y películas, necesitamos que verifiques tu correo electrónico.</p>
            <a class="button" href="{{ $verificationUrl }}">Verificar mi correo</a>
            <p>Si no te registraste en <strong>Marvelpedia</strong>, puedes ignorar este correo sin problemas.</p>
        </div>

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
                        <img src="https://marvelpedia.ruix.iesruizgijon.es/logo.png" alt="Marvelpedia"
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
