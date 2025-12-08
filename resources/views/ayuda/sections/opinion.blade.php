<!-- resources/views/ayuda/opinion.blade.php -->

<div id="opinion" class="card mt-4 shadow-sm mx-auto">
    <div class="card-header bg-success text-white">
        <h3 class="h5 mb-0 text-center">Déjanos tu opinión</h3>
    </div>

    <div class="card-body">
        @if (auth()->check())
            <form action="{{ route('support.enviar') }}" method="POST">
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

                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}"
                    hidden>

                <textarea name="feedback" rows="4" class="form-control" placeholder="Escribe tus comentarios..." required></textarea>

                <button type="submit" class="btn btn-success mt-3 w-100">
                    Enviar Feedback
                </button>
            </form>
        @else
            <p>Debes iniciar sesión para dejar tu opinión.</p>
        @endif
    </div>
</div>
