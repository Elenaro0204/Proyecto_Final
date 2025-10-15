# 🦸‍♂️ Marvelpedia

Marvelpedia es una aplicación web interactiva inspirada en el estilo de una enciclopedia tipo Wikipedia, dedicada íntegramente al Universo Marvel. Su propósito es ofrecer una plataforma moderna, visual y participativa donde los usuarios puedan:

- Consultar información detallada sobre **personajes, películas, series, cómics y equipos**.
- Crear **colecciones personalizadas**.
- Publicar **reseñas, teorías y opiniones**.
- Explorar un **árbol de relaciones genealógicas y alianzas** entre personajes.
- Disfrutar de una experiencia de navegación tipo wiki, pero más visual y dinámica.

---

## 🚀 Tecnologías utilizadas
| Tecnología | Uso |
|-----------|-----|
| **Laravel (MVC)** | Backend y estructura del proyecto |
| **MySQL** | Gestión de base de datos |
| **Blade + Tailwind/Bootstrap** | Frontend y vistas |
| **JavaScript + AJAX** | Funcionalidades dinámicas |
| **API interna RESTful** | Consumo de datos |
| **Autenticación Laravel Breeze / Jetstream / Fortify** | Sistema de login y roles |
| **Docker / Servidor real** | Despliegue en producción |

---

## 🎭 Roles de usuario
- **Usuario registrado** → Consulta contenidos, crea colecciones y comenta.
- **Usuario Premium** → Acceso a colecciones avanzadas y funciones exclusivas.
- **Administrador** → Gestión completa desde **panel de administración**.

---

## 📁 Instalación y configuración

```bash
# Clonar el repositorio
git clone https://github.com/tuusuario/marvelpedia.git
cd marvelpedia

# Instalar dependencias
composer install
npm install
npm run dev

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env y luego:
php artisan migrate --seed

# Iniciar servidor
php artisan serve

```

## 📌 Características principales

> ✔ Enciclopedia Marvel completa
> ✔ Sistema de colecciones personalizadas
> ✔ Comentarios, reseñas y teorías
> ✔ API interna propia
> ✔ Panel de administración con CRUDs
> ✔ Diseño responsive estilo wiki moderna
> ✔ Bootstrap/Tailwind y JavaScript dinámico con AJAX
> ✔ Roles: usuario, premium y administrador

## 🎯 Objetivo académico

Este proyecto forma parte del Proyecto Integrado del Ciclo de Desarrollo de Aplicaciones Web (DAW), cumpliendo con los requisitos de:

- Patrón MVC
- Uso de base de datos relacional
- Sistema de autenticación con roles
- Buenas prácticas backend/frontend
- Servidor real con despliegue funcional
- Documentación profesional

## 💡 Próximas mejoras

- Buscador inteligente con autocompletado
- Sistema de logros para usuarios activos
- Modo oscuro / personalización de interfaz
- Dashboard de estadísticas estilo Marvel Insider

## 📸 Capturas (pendiente de añadir)

Aquí se agregarán capturas de la interfaz una vez esté en fase final.

## 📜 Licencia

Este proyecto se desarrolla con fines educativos. Puedes adaptarlo y mejorarlo libremente.
