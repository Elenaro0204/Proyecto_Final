<!-- resources/views/ayuda/opinion.blade.php -->

<div id="opinion" class="card mt-4 shadow-sm mx-auto" style="max-width: 600px;">
    <div class="card-header bg-success text-white">
        <h3 class="h5 mb-0 text-center">Déjanos tu opinión</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('support.enviar') }}" method="POST">
            @csrf

            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}"
                hidden>

            <textarea name="feedback" rows="4" class="form-control" placeholder="Escribe tus comentarios..." required></textarea>

            <button type="submit" class="btn btn-success mt-3 w-100">
                Enviar Feedback
            </button>
        </form>
    </div>
</div>
