<!-- resources/views/ayuda/preguntas_frecuentes.blade.php -->
<div id="preguntas" class="card mt-4 shadow-lg rounded-3xl border-0">
    <div class="card-header bg-gradient-to-r from-red-600 to-blue-600 text-white text-center py-4">
        <h3 class="text-2xl font-bold">Prefuntas frecuentes</h3>
    </div>

    <div class="card-body space-y-3" x-data="{ open: 1 }">

        <!-- Pregunta 1 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 1 ? open = null : open = 1"
                class="w-full flex items-center justify-between p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <div class="flex items-center">
                    <i class="fas fa-unlock-alt text-red-600 mr-3"></i>
                    <p>¿Cómo puedo recuperar el acceso a mi cuenta?</p>
                </div>

                <!-- Flecha -->
                <i class="fas fa-chevron-down text-red-600 transition-transform duration-300"
                    :class="open === 1 ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open === 1" x-collapse class="p-4 text-gray-700 bg-white">
                Si has olvidado tu contraseña, selecciona la opción
                <strong>"Recuperar contraseña"</strong> en la pantalla de inicio de sesión.
                Introduce tu correo electrónico y recibirás un mensaje con los pasos para restablecerla de forma segura.
            </div>
        </div>

        <!-- Pregunta 2 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 2 ? open = null : open = 2"
                class="w-full flex items-center justify-between p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <div class="flex items-center">
                    <i class="fas fa-envelope text-red-600 mr-3"></i>
                    <p>¿Cómo puedo actualizar mi correo electrónico?</p>
                </div>

                <!-- Flecha -->
                <i class="fas fa-chevron-down text-red-600 transition-transform duration-300"
                    :class="open === 2 ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="open === 2" x-collapse class="p-4 text-gray-700 bg-white">
                Entra en tu perfil y accede a la sección <strong>"Editar Perfil"</strong> de tu cuenta.
                Desde ahí podrás modificar tu correo electrónico y guardarlo fácilmente.
            </div>
        </div>

        <!-- Pregunta 3 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 3 ? open = null : open = 3"
                class="w-full flex items-center justify-between p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <div class="flex items-center">
                    <i class="fas fa-trash-alt text-red-600 mr-3"></i>
                    <p>¿Es posible eliminar mi cuenta de Marvelpedia?</p>
                </div>
                <!-- Flecha -->
                <i class="fas fa-chevron-down text-red-600 transition-transform duration-300"
                    :class="open === 3 ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open === 3" x-collapse class="p-4 text-gray-700 bg-white">
                Sí. Desde la sección <strong>"Editar Perfil"</strong> puedes eliminar permanentemente tu cuenta.
                Si necesitas ayuda adicional, puedes contactar con soporte en:
                <a href="mailto:support@marvelpedia.com" class="text-blue-600 underline">support@marvelpedia.com</a>.
            </div>
        </div>

        <!-- Pregunta 4 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 4 ? open = null : open = 4"
                class="w-full flex items-center justify-between p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <div class="flex items-center">
                    <i class="fas fa-film text-red-600 mr-3"></i>
                    <p>¿Dónde puedo ver la información de películas y series?</p>
                </div>

                <!-- Flecha -->
                <i class="fas fa-chevron-down text-red-600 transition-transform duration-300"
                    :class="open === 4 ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open === 4" x-collapse class="p-4 text-gray-700 bg-white">
                En el menú <strong>"Descubre"</strong> encontrarás un buscador donde puedes escribir el título de
                cualquier película o
                serie.
                También puedes explorar nuevos contenidos que aparecen de forma aleatoria.
                <u>Cada vez que recargues la página, descubrirás recomendaciones diferentes.</u>
            </div>
        </div>

        <!-- Pregunta 5 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 5 ? open = null : open = 5"
                class="w-full flex items-center justify-between p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <div class="flex items-center">
                    <i class="fas fa-users text-red-600 mr-3"></i>
                    <p>¿Cómo puedo participar en los foros y escribir reseñas?</p>
                </div>

                <!-- Flecha -->
                <i class="fas fa-chevron-down text-red-600 transition-transform duration-300"
                    :class="open === 5 ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open === 5" x-collapse class="p-4 text-gray-700 bg-white">
                En la sección <strong>"Comunidad"</strong> tienes acceso tanto a los <strong>"Foros"</strong>, donde
                puedes debatir con otros fans, como a
                <strong>"Reseñas"</strong>, donde podrás compartir tus opiniones sobre las películas y series del UCM.
                <u>Solo necesitas estar registrado e iniciar sesión para participar activamente.</u>
            </div>
        </div>

    </div>
</div>
