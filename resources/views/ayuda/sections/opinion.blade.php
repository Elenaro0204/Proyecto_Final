<!-- resources/views/ayuda/opinion.blade.php -->

<div id="opinion" class="card mt-4 shadow-lg rounded-3xl border-0">
    <div class="card-header bg-gradient-to-r from-red-600 to-blue-600 text-white text-center py-4">
        <h3 class="text-2xl font-bold">Déjanos tu Opinión</h3>
    </div>

    <div class="card-body space-y-3">
        @if (auth()->check())
            <form action="{{ route('support.enviar') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-200 text-red-800 p-4 rounded mb-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="text" name="nombre" value="{{ Auth::user()->name }}" hidden>

                <input type="email" name="email" value="{{ Auth::user()->email }}" hidden>

                <input type="hidden" name="tipo" value="opinion">

                <textarea name="mensaje" rows="4" class="form-control" placeholder="Escribe tus comentarios..." required></textarea>

                <div class="flex justify-center mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">
                        Enviar Opinión
                    </button>
                </div>
            </form>
        @else
            <p>Debes iniciar sesión para dejar tu opinión.</p>
        @endif
    </div>
</div>
