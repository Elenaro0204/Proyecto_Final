# 🦸‍♀️ Marvelpedia — Enciclopedia interactiva del Universo Marvel
Marvelpedia es una aplicación web estilo wiki moderna dedicada al Universo Marvel. Diseñada como un proyecto académico profesional, integra funcionalidades dinámicas, gestión de usuarios, sistema de reseñas y foros, moderación avanzada y un panel completo de administración.

El objetivo es ofrecer una experiencia visual y participativa donde cualquier usuario pueda explorar contenido, compartir opiniones y debatir sobre películas y series del universo Marvel.

## 🌐 Características principales
- ✔ Enciclopedia completa con pelis, series y personajes
- ✔ Sistema de reseñas con puntuación (⭐ 1–5)
- ✔ Foros con publicaciones y comentarios
- ✔ Reportes avanzados con deadline y avisos al creador
- ✔ Panel de administración profesional
- ✔ API interna REST para uso dinámico
- ✔ Uso de AJAX para cargar info en modales (como el Drawer)
- ✔ Sistema de roles (guest, user, admin)
- ✔ Diseño responsive con Tailwind/Bootstrap
- ✔ Emails automáticos al reportar contenido
- ✔ Imágenes, avatares, posters y más

## 🧱 Tecnologías utilizadas
| Tecnología                        | Uso                                    |
| --------------------------------- | -------------------------------------- |
| **Laravel 10 (MVC)**              | Backend, rutas, controladores y lógica |
| **MySQL**                         | Base de datos relacional               |
| **Blade**                         | Vistas dinámicas                       |
| **TailwindCSS + Bootstrap**       | Estilos y diseño                       |
| **JavaScript + AJAX + Alpine.js** | Dinamismo y modales                    |
| **Laravel Breeze / Fortify**      | Autenticación                          |
| **Carbon**                        | Manipulación de fechas                 |
| **Mailables de Laravel**          | Notificaciones por correo              |
| **API REST interna**              | Datos para modales y AJAX              |
| **Servidor real**                 | Despliegue en producción               |

## 👥 Roles disponibles
### 🟥 Usuario sin registrar
- Puede explorar contenido general
- No puede escribir ni interactuar
### 🟦 Usuario registrado
- Puede comentar en foros
- Crear foros
- Publicar reseñas
- Reportar contenido
- Editar sus propios posts mientras el deadline esté activo
### 🟩 Administrador
- Acceso total al panel de administración
- CRUDs completos
- Revisión y resolución de reportes
- Gestión de usuarios y contenido

## 🔎 Sistema de reportes
Marvelpedia incluye un sistema muy completo:
- Un administrador puede reportar una reseña, foro o mensaje.
- El creador del contenido recibe un email automático.
- El administrador recibe copia del reporte.
- Se asigna un deadline para modificar el contenido.
- En el modal de detalle, si el usuario es el creador o admin, aparece:
> Aviso "⚠ Esta reseña ha sido reportada"
- Cuenta regresiva dinámica con años/meses/días/horas/minutos/segundos
- Al expirar el tiempo, el aviso aparece otro mensaje de que el tiempo ha expirado.
⚡ Todo esto funciona vía AJAX + Alpine.js y datos enviados desde Blade.

## 📁 Instalación
### Clonar el repositorio
```git clone https://github.com/Elenaro0204/marvelpedia.git```
```cd marvelpedia```

### Instalar dependencias
```composer install```
```npm install```
```npm run dev```

### Configurar entorno
```cp .env.example .env```
```php artisan key:generate```

### Configurar conexión MySQL en .env
### Luego ejecutar migraciones + seeds
```php artisan migrate --seed```

### Iniciar servidor local
```php artisan serve```

## 📚 Módulos principales
### 📝 Reseñas
- Contenido
- Nota 1–5 estrellas
- Posters e imágenes
- Usuario creador
- Sistema de reportes con contador
- Reportes y moderación

### 🗨️ Foros
- Temas creados por usuarios
- Comentarios anidados
- Sistema de reportes con contador
- Reportes y moderación

### 🧑‍💼 Panel Admin
- CRUDs completos
- Filtrado y paginación
- Resolución de reportes
- Gestión de usuarios

## 🎯 Objetivo académico
Marvelpedia forma parte del Proyecto Integrado del ciclo de Desarrollo de Aplicaciones Web (DAW), demostrando:
- ✔ Patrón MVC
- ✔ Base de datos relacional
- ✔ Autenticación y roles
- ✔ AJAX + API externa
- ✔ Emails automáticos
- ✔ Despliegue real
- ✔ Buenas prácticas backend/frontend
- ✔ Documentación profesional

## 🌙 Próximas mejoras
- 🔎 Buscador inteligente con autocompletado
- 🏆 Sistema de logros para usuarios activos
- ❤️ Favoritos y listas personalizadas

## 📸 Capturas de pantalla
(Pendiente de añadir cuando finalice la fase visual)

## 📜 Licencia
Este proyecto se desarrolla con fines educativos dentro del ciclo DAW. Puede usarse, modificarse y expandirse libremente.

