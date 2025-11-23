<!-- resources/views/resenas/create.blade.php -->
@extends('layouts.app')

@section('content')
    <!-- Sección de bienvenida con imagen de fondo -->
    <x-welcome-section title="¡Socorro! Necesito Ayuda"
        subtitle="Encuentra respuestas a tus preguntas frecuentes y aprende a navegar por Marvelpedia."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <div class="container m-5">
        <div class="row">
            <!-- Barra lateral con índice de secciones -->
            <div class="col-md-3">
                <aside
                    class="bg-gradient-to-br from-red-50 via-yellow-50 to-blue-50 shadow-2xl rounded-3xl p-3 sticky top-24 h-fit overflow-y-auto border-2 border-red-600">
                    <h3 class="text-xl font-extrabold text-red-600 mb-4 text-center animate-pulse">🦸 Menú de Ayuda</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#funcion"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i class="fas fa-cogs fa-lg text-red-500 group-hover:text-red-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">¿Cómo funciona el sistema?</span>
                            </a>
                        </li>
                        <li>
                            <a href="#contraseña"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-key fa-lg text-yellow-500 group-hover:text-yellow-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">¿Cómo cambiar mi contraseña?</span>
                            </a>
                        </li>
                        <li>
                            <a href="#comunes"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-question-circle fa-lg text-blue-500 group-hover:text-blue-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">Problemas comunes</span>
                            </a>
                        </li>
                        <li>
                            <a href="#soporte"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-headset fa-lg text-green-500 group-hover:text-green-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">Contacta con Soporte</span>
                            </a>
                        </li>
                        <li>
                            <a href="#pasoapaso"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-user-cog fa-lg text-purple-500 group-hover:text-purple-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">Guía paso a paso</span>
                            </a>
                        </li>
                        <li>
                            <a href="#consejos"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-lightbulb fa-lg text-orange-500 group-hover:text-orange-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">Consejos y trucos</span>
                            </a>
                        </li>
                        <li>
                            <a href="#preguntas"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-info-circle fa-lg text-teal-500 group-hover:text-teal-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">Preguntas frecuentes</span>
                            </a>
                        </li>
                        <li>
                            <a href="#notificaciones"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-bell fa-lg text-pink-500 group-hover:text-pink-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">Notificaciones y Alertas</span>
                            </a>
                        </li>
                        <li>
                            <a href="#opinion"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-comment-dots fa-lg text-indigo-500 group-hover:text-indigo-600 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">Déjanos tu opinión</span>
                            </a>
                        </li>
                        <li>
                            <a href="#externo"
                                class="flex items-center px-3 py-2 rounded-xl bg-white shadow-sm hover:shadow-md transform hover:-translate-y-0.5 hover:scale-102 transition-all duration-200 group">
                                <i
                                    class="fas fa-external-link-alt fa-lg text-gray-700 group-hover:text-gray-900 me-3 animate-bounce"></i>
                                <span class="font-semibold text-gray-800 text-sm">Recursos Externos</span>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Contenido principal -->
            <div class="col-md-9">

                <!-- Sección 1: ¿Cómo funciona el sistema? -->
                <div id="funcion" class="card mt-4 shadow-lg rounded-3xl border-0">
                    <div class="card-header bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white">
                        <h3 class="text-xl font-bold text-center">¿Cómo funciona el sistema?</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-4 text-center text-gray-700">
                            Explora Marvelpedia de manera fácil y divertida. Estas son sus funcionalidades principales:
                        </p>

                        <div class="row g-3">
                            <!-- Registro -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-user-plus fa-2x text-blue-500 mb-2"></i>
                                    <h5 class="font-bold">Registro</h5>
                                    <p class="text-sm text-gray-600">Crea tu cuenta para acceder a todas las funciones.</p>
                                </div>
                            </div>

                            <!-- Perfil -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-user-cog fa-2x text-purple-500 mb-2"></i>
                                    <h5 class="font-bold">Perfil</h5>
                                    <p class="text-sm text-gray-600">Personaliza tu foto, nombre y preferencias.</p>
                                </div>
                            </div>

                            <!-- Personajes -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-mask fa-2x text-red-500 mb-2"></i>
                                    <h5 class="font-bold">Personajes</h5>
                                    <p class="text-sm text-gray-600">Consulta información sobre todos los personajes de
                                        Marvel.</p>
                                </div>
                            </div>

                            <!-- Películas -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-film fa-2x text-yellow-500 mb-2"></i>
                                    <h5 class="font-bold">Películas</h5>
                                    <p class="text-sm text-gray-600">Explora la lista completa de películas y detalles
                                        importantes.</p>
                                </div>
                            </div>

                            <!-- Series -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-tv fa-2x text-green-500 mb-2"></i>
                                    <h5 class="font-bold">Series</h5>
                                    <p class="text-sm text-gray-600">Consulta y sigue tus series favoritas de Marvel.</p>
                                </div>
                            </div>

                            <!-- Cómics -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-book fa-2x text-blue-700 mb-2"></i>
                                    <h5 class="font-bold">Cómics</h5>
                                    <p class="text-sm text-gray-600">Accede a todos los cómics disponibles con información
                                        detallada.</p>
                                </div>
                            </div>

                            <!-- Foros -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-users fa-2x text-pink-500 mb-2"></i>
                                    <h5 class="font-bold">Foros</h5>
                                    <p class="text-sm text-gray-600">Participa en debates, preguntas y discusiones con la
                                        comunidad.</p>
                                </div>
                            </div>

                            <!-- Reseñas -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-comment-dots fa-2x text-indigo-500 mb-2"></i>
                                    <h5 class="font-bold">Reseñas</h5>
                                    <p class="text-sm text-gray-600">Escribe y consulta opiniones sobre películas, series y
                                        cómics.</p>
                                </div>
                            </div>

                            <!-- Favoritos -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-star fa-2x text-yellow-400 mb-2"></i>
                                    <h5 class="font-bold">Favoritos</h5>
                                    <p class="text-sm text-gray-600">Guarda tus contenidos preferidos para volver
                                        rápidamente.</p>
                                </div>
                            </div>

                            <!-- Notificaciones -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-bell fa-2x text-pink-500 mb-2"></i>
                                    <h5 class="font-bold">Notificaciones</h5>
                                    <p class="text-sm text-gray-600">Recibe alertas sobre novedades y respuestas
                                        importantes.</p>
                                </div>
                            </div>

                            <!-- Recursos externos -->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 shadow-sm hover:shadow-md rounded-2xl text-center p-3 transition-transform hover:-translate-y-1 hover:scale-105">
                                    <i class="fas fa-external-link-alt fa-2x text-gray-700 mb-2"></i>
                                    <h5 class="font-bold">Recursos</h5>
                                    <p class="text-sm text-gray-600">Accede a tutoriales, guías y contenido adicional.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Sección 2: Cambiar contraseña -->
                <div id="contraseña" class="card mt-4 shadow-sm border-0 rounded-3">
                    <div class="card-header bg-success text-white d-flex align-items-center">
                        <i class="bi bi-lock-fill me-2"></i>
                        <h3 class="mb-0">¿Cómo cambiar mi contraseña?</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">
                            Mantener tu cuenta segura es muy importante. Si tienes la sesión iniciada, puedes cambiar tu
                            contraseña directamente desde tu perfil de usuario.
                        </p>

                        <p class="mb-3">
                            Para hacerlo, sigue estos pasos:
                        </p>

                        <ol class="mb-3">
                            <li>Haz clic sobre tu nombre o avatar en la esquina superior derecha del menú.</li>
                            <li>Selecciona la opción <strong>“Perfil”</strong> o <strong>“Configuración de cuenta”</strong>.
                            </li>
                            <li>En la sección <strong>“Seguridad”</strong>, encontrarás la opción <em>“Cambiar
                                    contraseña”</em>.</li>
                            <li>Introduce tu contraseña actual, escribe la nueva y confírmala.</li>
                            <li>Guarda los cambios para aplicar la nueva contraseña.</li>
                        </ol>

                        <div class="alert alert-info">
                            Si has olvidado tu contraseña y no puedes acceder a tu cuenta, puedes recuperarla desde la
                            página de inicio de sesión haciendo clic en <strong>“¿Olvidaste tu contraseña?”</strong>.
                        </div>

                        <a href="{{ route('profile.edit') }}" class="btn btn-success mt-2">
                            <i class="bi bi-arrow-right-circle me-1"></i> Ir a mi perfil
                        </a>
                    </div>
                </div>

                <!-- Sección 3: Problemas comunes -->
                <div id="comunes" class="card mt-4 shadow-sm">
                    <div class="card-header bg-warning text-white">
                        <h3>Problemas comunes</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">Aquí tienes soluciones rápidas a los problemas más frecuentes:</p>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 border rounded shadow-sm bg-white">
                                    <h5 class="text-warning"><i class="fas fa-sign-in-alt me-2"></i>No puedo iniciar
                                        sesión</h5>
                                    <p class="mb-0">Verifica tu email y contraseña. Si olvidaste tu contraseña, utiliza
                                        el enlace de recuperación.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 border rounded shadow-sm bg-white">
                                    <h5 class="text-warning"><i class="fas fa-lock me-2"></i>Cuenta bloqueada</h5>
                                    <p class="mb-0">Contacta con soporte para desbloquear tu cuenta y restablecer tus
                                        credenciales.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 border rounded shadow-sm bg-white">
                                    <h5 class="text-warning"><i class="fas fa-exclamation-circle me-2"></i>Errores al
                                        cargar la página</h5>
                                    <p class="mb-0">Intenta limpiar la caché del navegador o recarga la página.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 border rounded shadow-sm bg-white">
                                    <h5 class="text-warning"><i class="fas fa-film me-2"></i>No puedo ver películas o
                                        series</h5>
                                    <p class="mb-0">Asegúrate de estar logueado y de que tu navegador soporta la
                                        reproducción de vídeos.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 border rounded shadow-sm bg-white">
                                    <h5 class="text-warning"><i class="fas fa-user me-2"></i>Personajes o cómics no cargan
                                    </h5>
                                    <p class="mb-0">Revisa tu conexión a internet o intenta actualizar la página.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 border rounded shadow-sm bg-white">
                                    <h5 class="text-warning"><i class="fas fa-comments me-2"></i>Problemas con foros o
                                        reseñas</h5>
                                    <p class="mb-0">Comprueba que estás logueado y que tu cuenta tiene permisos para
                                        comentar o crear reseñas.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-center">
                            <p class="mb-2">Si tienes alguna duda que no esté aquí, no dudes en contactarnos:</p>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#contactModal">
                                <i class="fas fa-envelope me-1"></i> Enviar correo a soporte
                            </button>
                        </div>

                        <!-- Modal de contacto -->
                        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title" id="contactModalLabel"><i
                                                class="fas fa-envelope me-2"></i>Contacta con soporte</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="https://formspree.io/f/mnnggdaz" method="POST" id="supportForm">
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Tu nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Tu correo</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mensaje" class="form-label">Mensaje</label>
                                                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-warning w-100">Enviar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección 4: Contacta con Soporte -->
                <div id="soporte" class="card mt-4 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h3>Contacta con Soporte</h3>
                    </div>
                    <div class="card-body">
                        <p>Si necesitas ayuda, puedes contactarnos por los siguientes medios o enviarnos un mensaje
                            directamente desde esta página:</p>
                        <ul>
                            <li><strong>Email:</strong> <a
                                    href="mailto:support@marvelpedia.com">support@marvelpedia.com</a></li>
                            <li><strong>Teléfono:</strong> +34 123 456 789</li>
                            <li><strong>Horario de atención:</strong> Lunes a Viernes, 09:00 - 18:00</li>
                            <li><strong>Documentación y ayuda rápida:</strong> <a href="{{ route('ayuda') }}">Consulta
                                    nuestra guía de ayuda</a></li>
                        </ul>

                        <!-- Botón para abrir modal de contacto -->
                        <div class="mt-3 text-center">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#soporteModal">
                                <i class="fas fa-envelope me-1"></i> Enviar mensaje a soporte
                            </button>
                        </div>
                    </div>

                    <!-- Modal de contacto -->
                    <div class="modal fade" id="soporteModal" tabindex="-1" aria-labelledby="soporteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="soporteModalLabel"><i
                                            class="fas fa-envelope me-2"></i>Contacta con soporte</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="https://formspree.io/f/mnnggdaz" method="POST" id="soporteForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Tu nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Tu correo</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mensaje" class="form-label">Mensaje</label>
                                            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-info w-100">Enviar mensaje</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección 5: Guía paso a paso -->
                <div id="pasoapaso" class="card mt-4 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h3>Guía paso a paso</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Sigue estos pasos para sacarle el máximo provecho a Marvelpedia:</p>

                        <div class="row g-3">
                            <!-- Paso 1 -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex align-items-start">
                                        <i class="fas fa-user-plus fa-2x text-secondary me-3 animate-bounce"></i>
                                        <div>
                                            <h5 class="card-title">1. Registrarse</h5>
                                            <p class="card-text">Crea tu cuenta con tu correo electrónico para empezar a
                                                explorar contenido.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Paso 2 -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex align-items-start">
                                        <i class="fas fa-id-badge fa-2x text-secondary me-3 animate-bounce"></i>
                                        <div>
                                            <h5 class="card-title">2. Configurar tu perfil</h5>
                                            <p class="card-text">Personaliza tu perfil, añade foto y actualiza tu nombre y
                                                preferencias.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Paso 3 -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex align-items-start">
                                        <i class="fas fa-film fa-2x text-secondary me-3 animate-bounce"></i>
                                        <div>
                                            <h5 class="card-title">3. Explorar contenido</h5>
                                            <p class="card-text">Consulta películas, series, personajes y cómics desde el
                                                menú de navegación.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Paso 4 -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex align-items-start">
                                        <i class="fas fa-comments fa-2x text-secondary me-3 animate-bounce"></i>
                                        <div>
                                            <h5 class="card-title">4. Participar en la comunidad</h5>
                                            <p class="card-text">Deja reseñas, comenta en los foros y comparte tu opinión
                                                con otros usuarios.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón final -->
                        <div class="mt-4 text-center">
                            <a href="{{ route('login') }}" class="btn btn-secondary w-50">
                                ¡Comienza ahora!
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Sección 6 -->
                <div id="consejos" class="card mt-4 shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h3>Consejos y Trucos</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Atajos de teclado:</strong> Usa "Ctrl + S" para guardar rápidamente.</li>
                            <li><strong>Personaliza tu perfil:</strong> Añade una foto de perfil.</li>
                        </ul>
                        <a href="#section6" class="btn btn-dark">Ver más detalles</a>
                    </div>
                </div>

                <!-- Sección 7: Preguntas Frecuentes -->
                <div id="preguntas" class="card mt-4 shadow-sm">
                    <h3 class="card-header bg-gradient-to-r from-blue-500 to-yellow-500 text-white">Preguntas Frecuentes</h3>

                    <div class="accordion" id="faqAccordion">
                        <!-- Pregunta 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-2 rounded-3">
                            <h2 class="accordion-header" id="faqHeadingOne">
                                <button class="accordion-button bg-light text-dark fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true"
                                    aria-controls="faqCollapseOne">
                                    <i class="fas fa-unlock-alt me-2 text-primary"></i> ¿Cómo recuperar mi cuenta?
                                </button>
                            </h2>
                            <div id="faqCollapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="faqHeadingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    Si has olvidado tu contraseña, haz clic en <strong>"Recuperar contraseña"</strong> en la
                                    página de
                                    inicio de sesión y sigue los pasos indicados. Recibirás un correo con instrucciones para
                                    restablecerla.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-2 rounded-3">
                            <h2 class="accordion-header" id="faqHeadingTwo">
                                <button class="accordion-button collapsed bg-light text-dark fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false"
                                    aria-controls="faqCollapseTwo">
                                    <i class="fas fa-envelope me-2 text-success"></i> ¿Cómo actualizar mi correo
                                    electrónico?
                                </button>
                            </h2>
                            <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    Accede a <strong>Configuración de cuenta</strong> desde tu perfil. Allí podrás
                                    actualizar tu dirección de
                                    correo electrónico de manera segura.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-2 rounded-3">
                            <h2 class="accordion-header" id="faqHeadingThree">
                                <button class="accordion-button collapsed bg-light text-dark fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false"
                                    aria-controls="faqCollapseThree">
                                    <i class="fas fa-trash-alt me-2 text-danger"></i> ¿Puedo eliminar mi cuenta?
                                </button>
                            </h2>
                            <div id="faqCollapseThree" class="accordion-collapse collapse"
                                aria-labelledby="faqHeadingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    Sí, puedes solicitar la eliminación de tu cuenta desde la sección de configuración de tu
                                    perfil o contactando con
                                    <a href="mailto:support@marvelpedia.com" class="text-primary fw-bold">soporte</a>.
                                    Todos tus datos serán borrados de manera segura.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 4 -->
                        <div class="accordion-item border-0 shadow-sm mb-2 rounded-3">
                            <h2 class="accordion-header" id="faqHeadingFour">
                                <button class="accordion-button collapsed bg-light text-dark fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false"
                                    aria-controls="faqCollapseFour">
                                    <i class="fas fa-film me-2 text-warning"></i> ¿Cómo consultar películas y series?
                                </button>
                            </h2>
                            <div id="faqCollapseFour" class="accordion-collapse collapse"
                                aria-labelledby="faqHeadingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    Puedes explorar todas las películas y series desde el menú principal de
                                    <strong>Contenido</strong>. Filtra por tipo, año o género para encontrar lo que quieras.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 5 -->
                        <div class="accordion-item border-0 shadow-sm mb-2 rounded-3">
                            <h2 class="accordion-header" id="faqHeadingFive">
                                <button class="accordion-button collapsed bg-light text-dark fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faqCollapseFive" aria-expanded="false"
                                    aria-controls="faqCollapseFive">
                                    <i class="fas fa-users me-2 text-purple"></i> ¿Cómo participar en foros y dejar
                                    reseñas?
                                </button>
                            </h2>
                            <div id="faqCollapseFive" class="accordion-collapse collapse"
                                aria-labelledby="faqHeadingFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    Desde tu perfil o desde la sección de <strong>Foros</strong> y <strong>Reseñas</strong>
                                    puedes comentar,
                                    publicar tus opiniones y calificar contenido. Mantén un lenguaje respetuoso y
                                    constructivo.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección 8 -->
                <div id="notificaciones" class="card mt-4 shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h3>Notificaciones y Alertas</h3>
                    </div>
                    <div class="card-body">
                        <p>Puedes gestionar tus alertas y notificaciones desde tu perfil.</p>
                        <a href="#section8" class="btn btn-danger">Ver más detalles</a>
                    </div>
                </div>

                <!-- Sección 9 -->
                <div id="opinion" class="card mt-4 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h3>Déjanos tu opinión</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ayuda') }}" method="POST">
                            @csrf
                            <textarea name="feedback" rows="4" class="form-control" placeholder="Escribe tus comentarios..." required></textarea>
                            <button type="submit" class="btn btn-success mt-2">Enviar Feedback</button>
                        </form>
                    </div>
                </div>

                <!-- Sección 10 -->
                <div id="externos" class="card mt-4 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h3>Recursos Externos</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><a href="https://www.ejemplo.com/tutorial1">Tutorial 1: Introducción a la plataforma</a>
                            </li>
                            <li><a href="https://www.ejemplo.com/video2">Video 2: Cómo usar las funciones avanzadas</a>
                            </li>
                        </ul>
                        <a href="#section10" class="btn btn-info">Ver más detalles</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
