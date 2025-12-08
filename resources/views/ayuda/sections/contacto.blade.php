<!-- resources/views/ayuda/contacto.blade.php -->
<div id="soporte" class="card mt-4 shadow-sm">
    <div class="card-header bg-info text-white">
        <h3>Contacta con Soporte</h3>
    </div>
    <div class="card-body">
        <p>Si necesitas ayuda, puedes contactarnos por los siguientes medios o enviarnos un mensaje
            directamente desde esta página:</p>
        <ul>
            <li><strong>Email:</strong> <a href="mailto:soportemarvelpedia@gmail.com">soportemarvelpedia@gmail.com</a>
            </li>
            <li><strong>Teléfono:</strong> +34 656 44 85 41</li>
            <li><strong>Horario de atención:</strong> Lunes a Viernes, 09:00 - 18:00</li>
            <li><strong>Documentación y ayuda rápida:</strong> <a href="{{ route('ayuda') }}">Consulta
                    nuestra guía de ayuda</a></li>
        </ul>

        <!-- Botón para abrir modal de contacto -->
        <div class="mt-3 text-center">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#soporteModal">
                <i class="fas fa-envelope me-1"></i> Enviar mensaje a soporte
            </button>
        </div>
    </div>

    <!-- Modal de contacto -->
    <div class="modal fade" id="soporteModal" tabindex="-1" aria-labelledby="soporteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="soporteModalLabel"><i class="fas fa-envelope me-2"></i>Contacta con
                        soporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
                        <button type="submit" class="btn btn-info w-100">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
