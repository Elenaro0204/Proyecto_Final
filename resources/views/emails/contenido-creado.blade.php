<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "Arial", sans-serif;
            background: #f3f5f7;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 620px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 30px 35px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
            color: #333;
        }

        h2 {
            text-align: center;
            color: #c62828;
            font-size: 26px;
            margin-bottom: 25px;
        }

        p {
            line-height: 1.6;
            color: #444;
            font-size: 15px;
            margin: 12px 0;
        }

        .section-title {
            margin-top: 25px;
            font-weight: bold;
            color: #222;
            font-size: 16px;
        }

        .highlight-box {
            background: #fde5ec;
            border-left: 4px solid #d81b60;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }

        .button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 22px;
            background: #1976d2;
            color: #fff !important;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .button:hover {
            background: #0d47a1;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #777;
            margin-top: 35px;
        }

        /* Firma */
        .signature-table {
            width: 100%;
            max-width: 430px;
            margin: 30px auto 0;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            font-family: Arial, sans-serif;
        }

        .signature-table img {
            width: 70px;
            border-radius: 8px;
        }

        .contact-info {
            color: #333;
            font-size: 14px;
            line-height: 1.5;
        }

        .contact-info a {
            color: #1976d2;
            text-decoration: none;
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
    </style>
</head>

<body>
    <div class="email-container">

        <h2>🔔 Contenido Creado</h2>

        <p>Hola <strong>{{ $user->name }}</strong>,</p>

        <div class="highlight-box">
            <p><strong>Se ha creado un nuevo contenido asociado a tu cuenta.</strong></p>
        </div>

        <p class="section-title">📌 Contenido afectado:</p>

        {{-- MENSAJE --}}
        @if ($tipo === 'mensaje')
            <p><strong>Mensaje:</strong></p>
            <div class="highlight-box">
                {{ $contenido->contenido }}
            </div>

            <p><a class="button" href="{{ $url ?? url('/foros') }}">👉 Ver nuevo mensaje</a></p>
            {{-- RESPUESTA --}}
        @elseif ($tipo === 'respuesta')
            <p><strong>Te han respondido en el foro:</strong></p>

            <p class="section-title">Tu mensaje original:</p>
            <div class="highlight-box" style="background:#e8f5e9; border-left:4px solid #43a047;">
                {{ $contenido->parent->contenido ?? 'Mensaje no disponible' }}
            </div>

            <p class="section-title">Nueva respuesta:</p>
            <div class="highlight-box">
                {{ $contenido->contenido }}
            </div>

            <p><a class="button" href="{{ $url ?? url('/foros') }}">👉 Ver respuesta</a></p>

            {{-- FORO --}}
        @elseif ($tipo === 'foro')
            <p><strong>Foro:</strong> {{ $contenido->titulo }}</p>

            <p class="section-title">Tu publicación:</p>
            <p><a class="button" href="{{ $url ?? url('/foros') }}">👉 Ver nuevo foro</a></p>

            {{-- RESEÑA --}}
        @elseif ($tipo === 'resena')
            <p><strong>Reseña de:</strong> {{ $contenido->entity_title }}</p>

            <p><strong>Valoración:</strong> {{ $contenido->rating }}/5 ⭐</p>

            <div class="highlight-box">
                {{ $contenido->content }}
            </div>

            <p><a class="button" href="{{ $url ?? url('/resenas') }}">👉 Ver nueva reseña</a></p>
        @else
            <p>Contenido modificado sin tipo especificado.</p>
        @endif

        <footer class="footer">
            <p>© {{ date('Y') }} Marvelpedia — Notificación automática. Por favor, no respondas a este correo.</p>

            <table
                style="width:100%; border-top:1px solid #ddd; margin-top:25px; padding-top:15px; font-family:Arial, sans-serif;">
                <tr>
                    <td style="vertical-align:top; width:70px; padding-right:15px;">
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
