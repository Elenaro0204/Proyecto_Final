
<!-- resources/views/ayuda/guia_paso.blade.php -->

<div id="pasoapaso" class="card mt-4 shadow-lg rounded-3xl border-0">
    <div class="card-header bg-gradient-to-r from-red-600 to-blue-600 text-white text-center py-4">
        <h3 class="text-2xl font-bold">Guía paso a paso</h3>
    </div>
    <div class="card-body">
        <p class="mb-4 text-center text-gray-700 text-lg">Sigue estos pasos para sacarle el máximo provecho a Marvelpedia:</p>

        <div class="row g-3 text-gray-800">
            <!-- Paso 1 -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-start">
                        <i class="fas fa-user-plus fa-2x text-red-500 me-3"></i>
                        <div>
                            <h5 class="card-title text-red-600 font-bold">1. Registrarse</h5>
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
                        <i class="fas fa-id-badge fa-2x text-red-500 me-3"></i>
                        <div>
                            <h5 class="card-title text-red-600 font-bold">2. Configurar tu perfil</h5>
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
                        <i class="fas fa-film fa-2x text-red-500 me-3"></i>
                        <div>
                            <h5 class="card-title text-red-600 font-bold">3. Explorar contenido</h5>
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
                        <i class="fas fa-comments fa-2x text-red-500 me-3"></i>
                        <div>
                            <h5 class="card-title text-red-600 font-bold">4. Participar en la comunidad</h5>
                            <p class="card-text">Deja reseñas, comenta en los foros y comparte tu opinión
                                con otros usuarios.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón final -->
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" type="button" class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">
                ¡Comienza ahora!
            </a>
        </div>
    </div>
</div>
