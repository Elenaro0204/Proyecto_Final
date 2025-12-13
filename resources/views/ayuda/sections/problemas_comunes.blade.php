<!-- resources/views/ayuda/problemas_comunes.blade.php -->
<div id="comunes" class="card mt-4 shadow-lg rounded-3xl border-0">
    <div class="card-header bg-gradient-to-r from-red-600 to-blue-600 text-white text-center py-4">
        <h3 class="text-2xl font-bold">Problemas comunes y soluciones</h3>
    </div>
    <div class="card-body">
        <p class="mb-4 text-center text-gray-700 text-lg">
            Aquí te damos soluciones rápidas a los problemas más frecuentes que pueden surgir en Marvelpedia.
        </p>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 border rounded-2xl shadow-md bg-white hover:scale-105 transition-transform">
                    <h5 class="text-red-600 font-bold"><i class="fas fa-sign-in-alt me-2"></i>No puedo iniciar sesión
                    </h5>
                    <p class="mb-0">Verifica tu email y contraseña. Si olvidaste tu contraseña, usa el enlace de
                        recuperación.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 border rounded-2xl shadow-md bg-white hover:scale-105 transition-transform">
                    <h5 class="text-red-600 font-bold"><i class="fas fa-lock me-2"></i>Cuenta bloqueada</h5>
                    <p class="mb-0">Contacta con soporte para desbloquear tu cuenta y restablecer tus credenciales.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 border rounded-2xl shadow-md bg-white hover:scale-105 transition-transform">
                    <h5 class="text-red-600 font-bold"><i class="fas fa-exclamation-circle me-2"></i>Errores al cargar
                        la página</h5>
                    <p class="mb-0">Intenta limpiar la caché del navegador o recarga la página.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 border rounded-2xl shadow-md bg-white hover:scale-105 transition-transform">
                    <h5 class="text-red-600 font-bold"><i class="fas fa-film me-2"></i>No puedo ver películas o series
                    </h5>
                    <p class="mb-0">Asegúrate de estar logueado y que tu navegador soporta la reproducción de vídeo.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 border rounded-2xl shadow-md bg-white hover:scale-105 transition-transform">
                    <h5 class="text-red-600 font-bold"><i class="fas fa-user me-2"></i>Personajes o cómics no cargan
                    </h5>
                    <p class="mb-0">Revisa tu conexión a internet o intenta actualizar la página.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 border rounded-2xl shadow-md bg-white hover:scale-105 transition-transform">
                    <h5 class="text-red-600 font-bold"><i class="fas fa-comments me-2"></i>Problemas con foros o reseñas
                    </h5>
                    <p class="mb-0">Comprueba que estás logueado y que tu cuenta tiene permisos para comentar o crear
                        reseñas.</p>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="mb-2 font-semibold">¿No está tu problema aquí? Contáctanos directamente:</p>
            <button type="button" class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition"
                data-bs-toggle="modal" data-bs-target="#contactModal">
                <i class="fas fa-envelope me-1"></i> Contactar con soporte
            </button>
        </div>

        <!-- Modal de contacto -->
        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-2xl shadow-lg">
                    <div class="modal-header bg-gradient-to-t from-red-600 to-blue-600 text-white">
                        <h5 class="modal-title" id="contactModalLabel"><i class="fas fa-envelope me-2"></i>Contacta con
                            soporte</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('support.enviar') }}" method="POST" id="supportForm">
                            @csrf

                            @if ($errors->any())
                                <div class="bg-red-200 text-red-800 p-4 rounded">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>- {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Tu nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Tu correo</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Mensaje</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                            </div>
                            <div class="flex justify-center mt-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
