<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            padding: 0;
            margin: 0;
        }

        .email-container {
            max-width: 600px;
            background: white;
            margin: 30px auto;
            padding: 25px 35px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            color: #333;
        }

        h2 {
            color: #d32f2f;
            text-align: center;
            margin-bottom: 25px;
        }

        p {
            line-height: 1.6;
            font-size: 15px;
            color: #444;
        }

        .section-title {
            font-weight: bold;
            color: #222;
            margin-top: 20px;
        }

        .highlight-box {
            background: #fce4ec;
            border-left: 4px solid #d81b60;
            padding: 12px 15px;
            margin: 15px 0;
            border-radius: 6px;
        }

        .deadline {
            background: #e3f2fd;
            border-left: 4px solid #1976d2;
            padding: 12px 15px;
            margin: 15px 0;
            border-radius: 6px;
            font-weight: bold;
        }

        .button {
            display: inline-block;
            margin: 25px 0;
            padding: 12px 22px;
            background: #1976d2;
            color: white !important;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .button:hover {
            background: #0d47a1;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <h2>🔔 Contenido Eliminado</h2>

        <p>Hola <strong>{{ $user->name }}</strong>,</p>

        <div class="highlight-box">
            <p><strong>Uno de tus contenidos ha sido eliminado.</strong></p>
        </div>

                {{-- PARA MENSAJES --}}
        @if ($tipo === 'mensaje')
            <p><strong>Mensaje:</strong></p>
            <p>{{ $contenido->contenido }}</p>

            {{-- PARA FOROS --}}
        @elseif ($tipo === 'foro')
            <p><strong>Foro:</strong> {{ $contenido->titulo }}</p>
            <p><strong>Tu publicación:</strong></p>
            <p>{{ $contenido->mensaje }}</p>
            {{-- PARA RESEÑAS --}}
        @elseif ($tipo === 'resena')
            <p><strong>Reseña de:</strong> {{ $contenido->entity_title }}</p>
            <p><strong>Tu valoración:</strong> {{ $contenido->rating }}/5 ⭐</p>
            <p><strong>Tu reseña:</strong></p>
            <p>{{ $contenido->content }}</p>

            {{-- POR SI FALTARA ALGO --}}
        @else
            <p>Contenido eliminado sin tipo específico.</p>
        @endif


        <footer class="footer">
            <p>© {{ date('Y') }} Marvelpedia — Notificación automática. Por favor, no respondas a este correo.</p>
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
