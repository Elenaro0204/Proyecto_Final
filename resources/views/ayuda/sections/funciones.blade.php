<!-- resources/views/ayuda/funciones.blade.php -->

<div id="funcion" class="card mt-4 shadow-lg rounded-3xl border-0">
    <div class="card-header bg-gradient-to-r from-red-600 to-blue-600 text-white text-center py-4">
        <h3 class="text-2xl font-bold mb-0">¿Qué puedes hacer en Marvelpedia?</h3>
    </div>

    <div class="card-body">
        <p class="mb-4 text-center text-gray-700 text-lg">
            Explora todo el universo Marvel: desde personajes y cómics hasta películas y series,
            interactúa con la comunidad y personaliza tu experiencia.
        </p>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

            <!-- Crear cuenta -->
            <div class="col">
                <a href="{{ route('register') }}" class="text-decoration-none">
                    <div
                        class="card h-100 shadow-md rounded-2xl text-center p-4 hover:scale-105 transition-transform cursor-pointer">
                        <i class="fas fa-user-plus fa-3x text-red-600 mb-3"></i>
                        <h5 class="font-bold text-xl text-dark">Crear cuenta</h5>
                        <p class="text-sm text-gray-600">Regístrate y guarda tus foros y tus reseñas.</p>
                    </div>
                </a>
            </div>

            <!-- Perfil -->
            <div class="col">
                <a href="{{ route('profile') }}" class="text-decoration-none">
                    <div
                        class="card h-100 shadow-md rounded-2xl text-center p-4 hover:scale-105 transition-transform cursor-pointer">
                        <i class="fas fa-id-badge fa-3x text-red-600 mb-3"></i>
                        <h5 class="font-bold text-xl text-dark">Perfil</h5>
                        <p class="text-sm text-gray-600">Actualiza tu avatar, tu nombre y tus preferencias.</p>
                    </div>
                </a>
            </div>

            <!-- Películas -->
            <div class="col">
                <a href="{{ route('peliculas.index') }}" class="text-decoration-none">
                    <div
                        class="card h-100 shadow-md rounded-2xl text-center p-4 hover:scale-105 transition-transform cursor-pointer">
                        <i class="fas fa-film fa-3x text-red-600 mb-3"></i>
                        <h5 class="font-bold text-xl text-dark">Películas</h5>
                        <p class="text-sm text-gray-600">Consulta todas las películas del UCM.</p>
                    </div>
                </a>
            </div>

            <!-- Series -->
            <div class="col">
                <a href="{{ route('series') }}" class="text-decoration-none">
                    <div
                        class="card h-100 shadow-md rounded-2xl text-center p-4 hover:scale-105 transition-transform cursor-pointer">
                        <i class="fas fa-tv fa-3x text-red-600 mb-3"></i>
                        <h5 class="font-bold text-xl text-dark">Series</h5>
                        <p class="text-sm text-gray-600">Descubre episodios, tramas de tus series favoritas del UCM.</p>
                    </div>
                </a>
            </div>

            <!-- Foros -->
            <div class="col">
                <a href="{{ route('foros.index') }}" class="text-decoration-none">
                    <div
                        class="card h-100 shadow-md rounded-2xl text-center p-4 hover:scale-105 transition-transform cursor-pointer">
                        <i class="fas fa-users fa-3x text-red-600 mb-3"></i>
                        <h5 class="font-bold text-xl text-dark">Foros</h5>
                        <p class="text-sm text-gray-600">Comparte teorías y debate con otros fans.</p>
                    </div>
                </a>
            </div>

            <!-- Reseñas -->
            <div class="col">
                <a href="{{ route('resenas') }}" class="text-decoration-none">
                    <div
                        class="card h-100 shadow-md rounded-2xl text-center p-4 hover:scale-105 transition-transform cursor-pointer">
                        <i class="fas fa-comment-dots fa-3x text-red-600 mb-3"></i>
                        <h5 class="font-bold text-xl text-dark">Reseñas</h5>
                        <p class="text-sm text-gray-600">Escribe y consulta opiniones sobre el universo Marvel.</p>
                    </div>
                </a>
            </div>

        </div>

    </div>
</div>
