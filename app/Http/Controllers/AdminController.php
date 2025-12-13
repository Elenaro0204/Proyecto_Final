<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Middleware\IsAdmin;
use App\Mail\ContenidoCancelarReportadoMail;
use App\Mail\ContenidoReportadoMail;
use App\Models\Foro;
use App\Models\ForoReport;
use App\Models\Mensaje;
use App\Models\MensajeReport;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\ReviewReport;
use App\Notifications\ReviewReported;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    // Dashboard principal
    public function dashboard(Request $request)
    {
        $this->checkAdmin();

        $query = User::query();

        // 🔍 Búsqueda por nombre, email o nickname
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('nickname', 'like', "%$q%");
            });
        }

        // 👤 Filtro por rol
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // ✔ Filtro por verificación email
        if ($request->filled('verified')) {
            if ($request->verified === "1") {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }

        // 📄 Paginación
        $users = $query->paginate(10)->withQueryString();

        // Si la petición es AJAX → devolver solo la tabla
        if ($request->ajax()) {
            return view('admin.users.partials.users-table', compact('users'))->render();
        }

        return view('admin.dashboard', compact('users'));
    }

    // Mostrar formulario de edición
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    // Actualizar usuario
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'nickname' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
            'pais' => 'nullable|string|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'role' => 'required|in:user,admin',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Actualizamos solo los campos permitidos
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nickname = $request->nickname;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->pais = $request->pais;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->role = $request->role;

        // Primero eliminar si se ha solicitado
        if ($request->has('delete_avatar')) {
            if ($user->avatar_url && file_exists(public_path($user->avatar_url))) {
                unlink(public_path($user->avatar_url));
            }
            $user->avatar_url = null;
        }

        // Luego subir nueva foto si se ha enviado
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');
            $user->avatar_url = $path;
        }

        $user->save();

        return redirect()->route('admin.dashboard')->with('status', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.dashboard')->with('status', 'Usuario eliminado correctamente.');
    }

    // Gestión de contenido
    public function manageContent(Request $request)
    {
        // ------------------ RESEÑAS ------------------
        $reviewsQuery = Review::with(['user', 'report.reporter'])->latest();

        if ($request->filled('q')) {
            $reviewsQuery->where(function ($q) use ($request) {
                $q->where('content', 'like', "%{$request->q}%")
                    ->orWhere('entity_id', 'like', "%{$request->q}%");
            });
        }

        if ($request->filled('type')) {
            $reviewsQuery->where('type', $request->type);
        }

        $reviews = $reviewsQuery->paginate(10);

        $reviews->getCollection()->transform(function ($review) {
            // Por defecto ponemos null
            $review->entity_title = null;

            if (in_array($review->type, ['pelicula', 'serie'])) {
                // Llamada a la nueva API TMDB
                $apiKey = '068f9f8748c67a559a92eafb6a8eeda7';
                $endpoint = $review->type === 'pelicula' ? 'movie' : 'tv';

                $response = Http::get("https://api.themoviedb.org/3/{$endpoint}/{$review->entity_id}", [
                    'api_key' => $apiKey,
                    'language' => 'es-ES',
                ]);

                if ($response->ok()) {
                    $data = $response->json();
                    $review->entity_title = $data['title'] ?? $data['name'] ?? $review->entity_id;
                } else {
                    $review->entity_title = $review->entity_id;
                }
            }

            return $review;
        });

        // ------------------ FOROS ------------------
        $forosQuery = Foro::withCount('mensajes')->with('user')->latest();

        if ($request->filled('q_foros')) {
            $forosQuery->where('titulo', 'like', "%{$request->q_foros}%")
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->q_foros}%");
                });
        }

        $foros = $forosQuery->paginate(10, ['*'], 'foros_page');

        if ($request->ajax() && $request->type_ajax === 'foros') {
            return view('admin.foros.partials.foros-table', compact('foros'))->render();
        }

        return view('admin.manage-content', compact('reviews', 'foros'));
    }

    // Ver reportes
    public function reports()
    {
        // Podrías traer reportes de usuarios, contenidos o errores
        return view('admin.reports');
    }

    // Configuración del sitio
    public function settings()
    {
        // Configuración general del sitio
        return view('admin.settings');
    }

    public function reportReview(Review $review)
    {
        // Crear el reporte, calcular expiración, enviar mail, etc.
        ReviewReport::create([
            'review_id' => $review->id,
            'reporter_id' => Auth::id(),
            'expires_at' => now()->addHours(24), // por ejemplo
        ]);

        // Opcional: enviar email al usuario
        // Mail::to($review->user->email)->send(new ReviewReported($review));

        return back()->with('success', 'Reporte enviado correctamente.');
    }

    // Mostrar el formulario para reportar reseñas
    public function showReportFormResenas(Review $review)
    {
        // Comprobar si ya existe reporte
        $report = ReviewReport::where('review_id', $review->id)->where('reported_by', Auth::id())->first();
        if ($report) {
            return redirect()->route('admin.resenas.viewreport', $review);
        }
        return view('admin.resenas.addreport', compact('review'));
    }

    // Mostrar el formulario para reportar foros
    public function showReportFormForos(Foro $foro)
    {
        // Comprobar si ya existe un reporte de este foro por el usuario actual
        $report = ForoReport::where('foro_id', $foro->id)
            ->where('reported_by', Auth::id())
            ->first();

        if ($report) {
            return redirect()->route('admin.foros.viewreport', $foro);
        }

        // Mostrar el formulario para reportar este foro
        return view('admin.foros.addreport', compact('foro'));
    }

    // Mostrar formulario para reportar mensajes
    public function showReportFormMensajes(Mensaje $mensaje)
    {
        $report = $mensaje->reports()->where('reported_by', Auth::id())->first();
        if ($report) {
            return redirect()->route('admin.mensajes.viewreport', $mensaje);
        }
        return view('admin.mensajes.addreport', compact('mensaje'));
    }

    // Guardar reporte reseñas
    public function storeReportResenas(Request $request, Review $review)
    {
        $request->validate([
            'resolved' => 'required|boolean',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        // Crear el reporte
        $reporte = ReviewReport::create([
            'review_id'  => $review->id,
            'reported_by' => Auth::id(),
            'resolved'    => $request->resolved,
            'deadline'    => $request->deadline
                ? Carbon::parse($request->deadline)
                : Carbon::now()->addHours(24),
        ]);

        // Dueño del contenido
        $owner = $review->user;

        // Usuario que reporta
        $reporter = Auth::user();

        // Tipo
        $tipo = 'reseña';

        $link = url("/{$review->type}/{$review->entity_id}");

        // Enviar email al dueño
        Mail::to($owner->email)->send(
            new ContenidoReportadoMail($owner, $review, $reporter, $reporte, $link, $tipo)
        );

        // Copia al admin
        Mail::to("soportemarvelpedia@gmail.com")->send(
            new ContenidoReportadoMail($owner, $review, $reporter, $reporte, $link, $tipo)
        );

        return back()->with('success', 'Reporte enviado correctamente.');
    }


    // Guardar reporte foros
    public function storeReportForos(Request $request, Foro $foro)
    {
        $request->validate([
            'resolved' => 'required|boolean',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        $reporte = ForoReport::create([
            'foro_id' => $foro->id,
            'reported_by' => Auth::id(),
            'resolved'    => $request->resolved,
            'deadline' => $request->deadline ? Carbon::parse($request->deadline) : Carbon::now()->addHours(24),
        ]);

        // Dueño del contenido
        $owner = $foro->user;

        // Tipo
        $tipo = 'foro';

        // Usuario que reporta
        $reporter = Auth::user();

        $link = route('foros.show', [
            'foro'   => $foro->id
        ]);

        // Enviar email al dueño
        Mail::to($owner->email)->send(
            new ContenidoReportadoMail($owner, $foro, $reporter, $reporte, $link, $tipo)
        );

        // Copia al admin
        Mail::to("soportemarvelpedia@gmail.com")->send(
            new ContenidoReportadoMail($owner, $foro, $reporter, $reporte, $link, $tipo)
        );

        return redirect($request->input('redirect_to', url()->previous()))
            ->with('success', 'Reporte enviado correctamente.');
    }

    // Guardar reporte mensajes
    public function storeReportMensajes(Request $request, Mensaje $mensaje)
    {
        $request->validate([
            'resolved' => 'required|boolean',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        $reporte = $mensaje->reports()->create([
            'reported_by' => Auth::id(),
            'resolved' => $request->resolved,
            'deadline' => $request->deadline ? Carbon::parse($request->deadline) : Carbon::now()->addHours(24),
        ]);

        // Dueño del contenido
        $owner = $mensaje->user;

        // Usuario que reporta
        $reporter = Auth::user();

        // Tipo
        $tipo = 'mensaje';

        $link = route('foros.show', [
            'foro'   => $mensaje->foro_id,
        ]);

        // Enviar email al dueño
        Mail::to($owner->email)->send(
            new ContenidoReportadoMail($owner, $mensaje, $reporter, $reporte, $link, $tipo)
        );

        // Copia al admin
        Mail::to("soportemarvelpedia@gmail.com")->send(
            new ContenidoReportadoMail($owner, $mensaje, $reporter, $reporte, $link, $tipo)
        );

        // Redirige de vuelta al listado del foro con un hash para abrir el modal
        return redirect($request->input('redirect_to', url()->previous()))
            ->with('success', 'Reporte enviado correctamente.');
    }

    // Ver detalle del reporte de reseñas
    public function viewReportResena(Review $review)
    {
        $reports = ReviewReport::with('reporter', 'review')
            ->where('review_id', $review->id)
            ->get();

        if (!$reports) {
            return redirect()->route('admin.resenas.manage-content', $review)
                ->with('warning', 'Este review aún no tiene reporte.');
        }

        return view('admin.resenas.viewreport', compact('reports', 'review'));
    }

    // Ver detalle del reporte de foros
    public function viewReportForo(Foro $foro)
    {
        $report = ForoReport::with('reporter', 'foro')
            ->where('foro_id', $foro->id)
            ->first();

        return view('admin.foros.viewreport', compact('report', 'foro'));
    }

    // Ver detalle del reporte de mensajes
    public function viewReportMensaje(Mensaje $mensaje)
    {
        $report = $mensaje->reports()->with('reporter')->first();
        return view('admin.mensajes.viewreport', compact('report', 'mensaje'));
    }

    // Cancelar reporte reseñas
    public function cancelReportResena(Request $request, ReviewReport $report)
    {
        $review = $report->review;

        $report->delete();

        $remainingReports = ReviewReport::where('review_id', $review->id)->count();

        if ($remainingReports === 0) {
            $review->update(['resolved' => false]);
        }

        // Dueño del contenido
        $owner = $review->user;

        // Tipo
        $tipo = 'reseña';

        $link = url("/{$review->type}/{$review->entity_id}");

        // Enviar email al dueño
        Mail::to($owner->email)->send(
            new ContenidoCancelarReportadoMail($owner, $review, $link, $tipo)
        );

        // Copia al admin
        Mail::to("soportemarvelpedia@gmail.com")->send(
            new ContenidoCancelarReportadoMail($owner, $review, $link, $tipo)
        );

        return redirect($request->input('redirect_to', url()->previous()))
            ->with('success', 'Reporte cancelado.');
    }

    // Cancelar reporte foros
    public function cancelReportForo(Request $request, ForoReport $report)
    {
        $foro = $report->foro;

        $report->delete();

        $remainingReports = ForoReport::where('foro_id', $foro->id)->count();

        if ($remainingReports === 0) {
            $foro->update(['resolved' => false]);
        }

        // Dueño del contenido
        $owner = $foro->user;

        // Tipo
        $tipo = 'foro';

        $link = route('foros.show', [
            'foro'   => $foro->id,
        ]);

        // Enviar email al dueño
        Mail::to($owner->email)->send(
            new ContenidoCancelarReportadoMail($owner, $foro, $link, $tipo)
        );

        // Copia al admin
        Mail::to("soportemarvelpedia@gmail.com")->send(
            new ContenidoCancelarReportadoMail($owner, $foro, $link, $tipo)
        );

        return redirect($request->input('redirect_to', url()->previous()))
            ->with('success', 'Reporte cancelado.');
    }

    // Cancelar reporte mensajes
    public function cancelReportMensaje(Request $request, MensajeReport $report)
    {
        $mensaje = $report->mensaje;

        $report->delete();

        if ($mensaje->reports()->count() === 0) {
            $mensaje->update(['resolved' => false]);
        }

        // Dueño del contenido
        $owner = $mensaje->user;

        // Usuario que reporta
        $reporter = Auth::user();

        // Tipo
        $tipo = 'mensaje';

        $link = route('foros.show', [
            'foro'   => $mensaje->foro_id,
        ]);

        // Enviar email al dueño
        Mail::to($owner->email)->send(
            new ContenidoCancelarReportadoMail($owner, $mensaje, $link, $tipo)
        );

        // Copia al admin
        Mail::to("soportemarvelpedia@gmail.com")->send(
            new ContenidoCancelarReportadoMail($owner, $mensaje, $link, $tipo)
        );

        return redirect($request->input('redirect_to', url()->previous()))
            ->with('success', 'Reporte cancelado.');
    }

    // Obtener mensajes de un foro
    public function mensajesForo(Request $request, $foroId)
    {
        $perPage = $request->query('perPage', 5);

        $mensajes = Mensaje::with(['user', 'reporter']) // reporter es quien hizo el reporte
            ->withCount('respuestas')
            ->where('foro_id', $foroId)
            ->paginate($perPage);

        $mensajesArray = $mensajes->map(function ($msg) {
            $report = $msg->reports->isNotEmpty(); // puede ser null

            $ultimoReporte = $msg->reports->sortByDesc('created_at')->first();

            $deadline = null;
            if ($ultimoReporte && $ultimoReporte->deadline) {
                $deadline = Carbon::parse($ultimoReporte->deadline)->toIso8601String();
            }

            return [
                'id' => $msg->id,
                'usuario' => $msg->user->name ?? 'Desconocido',
                'contenido' => $msg->contenido,
                'fecha' => $msg->created_at->format('d/m/Y H:i'),
                'reportado' => $report ? true : false,
                'deadline' => $deadline,
                'respuestas_count' => $msg->respuestas_count,
            ];
        });

        return response()->json([
            'mensajes' => $mensajesArray,
            'totalPages' => $mensajes->lastPage(),
        ]);
    }
}
