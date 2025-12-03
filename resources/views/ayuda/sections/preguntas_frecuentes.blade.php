<!-- resources/views/ayuda/preguntas_frecuentes.blade.php -->
<div id="preguntas" class="mt-6 bg-white shadow-lg rounded-xl p-6">
    <h3 class="text-xl font-bold text-white p-4 rounded-lg bg-gradient-to-r from-blue-500 to-yellow-500">
        Preguntas Frecuentes
    </h3>

    <div class="space-y-3 mt-4" x-data="{ open: 1 }">

        <!-- Pregunta 1 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 1 ? open = null : open = 1"
                class="w-full flex items-center p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <i class="fas fa-unlock-alt text-blue-600 mr-3"></i>
                ¿Cómo recuperar mi cuenta?
            </button>

            <div x-show="open === 1" x-collapse class="p-4 text-gray-700 bg-white">
                Si has olvidado tu contraseña, haz clic en
                <strong>"Recuperar contraseña"</strong> en la página de inicio de sesión.
                Recibirás un correo con instrucciones para restablecerla.
            </div>
        </div>

        <!-- Pregunta 2 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 2 ? open = null : open = 2"
                class="w-full flex items-center p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <i class="fas fa-envelope text-green-600 mr-3"></i>
                ¿Cómo actualizar mi correo electrónico?
            </button>

            <div x-show="open === 2" x-collapse class="p-4 text-gray-700 bg-white">
                Accede a <strong>Configuración de cuenta</strong> desde tu perfil para actualizar tu correo.
            </div>
        </div>

        <!-- Pregunta 3 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 3 ? open = null : open = 3"
                class="w-full flex items-center p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <i class="fas fa-trash-alt text-red-600 mr-3"></i>
                ¿Puedo eliminar mi cuenta?
            </button>

            <div x-show="open === 3" x-collapse class="p-4 text-gray-700 bg-white">
                Sí, desde tu configuración puedes solicitar eliminar tu cuenta o contactar a
                <a href="mailto:support@marvelpedia.com" class="text-blue-600 underline">soporte</a>.
            </div>
        </div>

        <!-- Pregunta 4 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 4 ? open = null : open = 4"
                class="w-full flex items-center p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <i class="fas fa-film text-yellow-500 mr-3"></i>
                ¿Cómo consultar películas y series?
            </button>

            <div x-show="open === 4" x-collapse class="p-4 text-gray-700 bg-white">
                Desde el menú <strong>Contenido</strong> puedes filtrar por tipo, año o género.
            </div>
        </div>

        <!-- Pregunta 5 -->
        <div class="border rounded-lg overflow-hidden shadow transition">
            <button @click="open === 5 ? open = null : open = 5"
                class="w-full flex items-center p-4 bg-gray-100 hover:bg-gray-200 transition font-semibold text-left">
                <i class="fas fa-users text-purple-600 mr-3"></i>
                ¿Cómo participar en foros y dejar reseñas?
            </button>

            <div x-show="open === 5" x-collapse class="p-4 text-gray-700 bg-white">
                Desde la sección <strong>Foros</strong> y <strong>Reseñas</strong> puedes comentar y compartir
                contenido.
            </div>
        </div>

    </div>
</div>
