<!-- resources/views/ayuda/contacto.blade.php -->
<div id="soporte" class="card mt-4 shadow-lg rounded-3xl border-0">
    <div class="card-header bg-gradient-to-r from-red-600 to-blue-600 text-white text-center py-4">
        <h3 class="text-2xl font-bold">Contacta con Soporte</h3>
    </div>
    <div class="card-body">
        <p class="mb-4 text-center text-gray-700 text-lg">Si necesitas ayuda, puedes contactarnos por los siguientes
            medios o enviarnos un mensaje
            directamente desde esta página:</p>

        <ul class="space-y-3 text-gray-800">

            <li class="flex items-start gap-3 p-3 bg-white rounded-xl shadow-sm hover:shadow-md transition">
                <i class="fas fa-envelope text-red-500 text-xl mt-1"></i>
                <div>
                    <strong>Email:</strong>
                    <a href="mailto:soportemarvelpedia@gmail.com" class="text-blue-600 hover:text-blue-800 underline">
                        soportemarvelpedia@gmail.com
                    </a>
                </div>
            </li>

            <li class="flex items-start gap-3 p-3 bg-white rounded-xl shadow-sm hover:shadow-md transition">
                <i class="fas fa-phone-alt text-red-500 text-xl mt-1"></i>
                <div>
                    <strong>Teléfono:</strong> +34 656 44 85 41
                </div>
            </li>

            <li class="flex items-start gap-3 p-3 bg-white rounded-xl shadow-sm hover:shadow-md transition">
                <i class="fas fa-clock text-red-500 text-xl mt-1"></i>
                <div>
                    <strong>Horario de atención:</strong>
                    Lunes a Viernes, 09:00 - 18:00
                </div>
            </li>

            <li class="p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition">

                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-book text-red-500 text-xl"></i>
                    <strong class="text-lg">Documentación y ayuda rápida:</strong>
                </div>

                <div class="space-y-3">

                    @php
                        $docs = [
                            [
                                'titulo' => 'Guía para el Usuario',
                                'descripcion' => 'Explicación general del sistema.',
                                'icono' => 'fa-file-alt',
                                'link' =>
                                    'https://drive.google.com/u/0/uc?id=1XccbrfmZNv-Kc_dzYPmaiFBaOLHnUxkb&export=download',
                            ],
                            [
                                'titulo' => 'Memoria del Proyecto',
                                'descripcion' => 'Documentación completa del desarrollo.',
                                'icono' => 'fa-tools',
                                'link' =>
                                    'https://drive.google.com/u/0/uc?id=13Cz41zEHQ9PHJshodHc_cqxImr386H9o&export=download',
                            ],
                            [
                                'titulo' => 'Presentación del Proyecto',
                                'descripcion' => 'Slides del resumen final.',
                                'icono' => 'fa-chalkboard',
                                'link' =>
                                    'https://drive.google.com/u/0/uc?id=1z8PWqAAhhvB-G6FvOK4Xthunj8-AAzfw&export=download',
                            ],
                        ];
                    @endphp

                    @foreach ($docs as $doc)
                        <a href="{{ $doc['link'] }}" target="_blank"
                            class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition border border-gray-200 shadow-sm">

                            <i class="fas {{ $doc['icono'] }} text-red-600 text-2xl mt-1"></i>

                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $doc['titulo'] }}</h4>
                                <p class="text-xs text-gray-600">{{ $doc['descripcion'] }}</p>
                            </div>
                        </a>
                    @endforeach

                </div>

            </li>

        </ul>

        <!-- Botón para abrir modal de contacto -->
        <div class="mt-3 text-center">
            <button type="button"
                class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition"
                data-bs-toggle="modal" data-bs-target="#soporteModal">
                <i class="fas fa-envelope me-1"></i> Contactar con soporte
            </button>
        </div>
    </div>

    <!-- Modal de contacto -->
    <div class="modal fade" id="soporteModal" tabindex="-1" aria-labelledby="soporteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-2xl shadow-lg">
                <div class="modal-header bg-gradient-to-t from-red-600 to-blue-600 text-white">
                    <h5 class="modal-title" id="soporteModalLabel"><i class="fas fa-envelope me-2"></i>Contacta con
                        soporte</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('support.enviar') }}" method="POST" id="soporteForm">
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
