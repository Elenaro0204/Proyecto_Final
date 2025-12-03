
<!-- resources/views/ayuda/guia_paso.blade.php -->

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
