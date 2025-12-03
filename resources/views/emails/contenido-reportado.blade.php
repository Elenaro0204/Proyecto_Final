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

        hr {
            margin: 30px 0;
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <h2>🔔 Contenido Reportado</h2>

        <p>Hola <strong>{{ $owner->name }}</strong>,</p>

        <div class="highlight-box">
            <p><strong>Uno de tus contenidos ha sido reportado.</strong></p>
        </div>

        <p class="section-title">📌 Contenido afectado:</p>
        <p>{{ $contenido->entity_title ?? $contenido->contendio ?? $contenido->titulo ?? 'Sin título' }}</p>

        <p class="section-title">👤 Reportado por:</p>
        <p>{{ $reporter->name }}</p>

        <p class="section-title">⏳ Fecha límite para resolver:</p>
        <div class="deadline">
            {{ $reporte->deadline->format('d/m/Y H:i') }}
        </div>

        <center>
            <a href="{{ $link }}" class="button">🔍 Ver reporte</a>
        </center>

        <hr>

        <p>
            Por favor, revisa la plataforma para tomar las acciones necesarias.<br>
            Mantener tu contenido revisado ayuda a que la comunidad continúe siendo un espacio seguro.
        </p>

        <div class="footer">
            <p>© {{ date('Y') }} Marvelpedia — Sistema de revisión de contenido</p>
        </div>

    </div>
</body>

</html>
