<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Especie;
use App\Models\Habitat;
use App\Models\Imagen;
use App\Models\Taxonomia;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class EspecieApiController extends Controller
{

    public function index(Request $request)
{
    $user = $request->user();

   
    if (!$user) {
        return $this->listado_especies_invitado($request);
    }

    
    $query = Especie::with(['taxonomia', 'imagenes', 'habitats', 'ubicaciones']);

   
    if ($request->has('tipo') && in_array($request->tipo, ['flora', 'fauna'])) {
        $query->where('tipo', $request->tipo);
    }

    if ($request->has('familia')) {
        $query->whereHas('taxonomia', function ($q) use ($request) {
            $q->where('familia', $request->familia);
        });
    }

    if ($request->has('ubicacion')) {
        $query->whereHas('ubicaciones', function ($q) use ($request) {
            $q->where('ubicacion_id', $request->ubicacion);
        });
    }

    if ($request->has('habitat')) {
        $query->whereHas('habitats', function ($q) use ($request) {
            $q->where('habitat_id', $request->habitat);
        });
    }

    if ($request->has('buscar') && ! empty($request->buscar)) {
        $termino = $request->buscar;
        $query->where(function ($q) use ($termino) {
            $q->where('nombre_cientifico', 'LIKE', "%{$termino}%")
              ->orWhere('nombre_vernaculo',   'LIKE', "%{$termino}%")
              ->orWhere('descripcion',        'LIKE', "%{$termino}%");
        });
    }

    if (!$user || ! in_array($user->rol, ['profesor', 'admin'])) {
        $query->where('estado', 'aprobada');
    }

    $especies = $query->orderBy('id')->paginate(8)->withQueryString();

    $especies->getCollection()->transform(function ($especie) {
        
        $imagenPrincipal = $especie->imagenes->where('es_principal', true)->first()
                          ?? $especie->imagenes->first();

        $especie->imagen_url = $imagenPrincipal
            ? url($imagenPrincipal->ruta)
            : url('img/especies/' . $especie->tipo . '/default.jpg');

        return $especie;
    });

    return response()->json([
        'debug'    => [
            'is_guest' => is_null($user),
            'user_id'  => optional($user)->id,
            'rol'      => optional($user)->rol,
        ],
        'especies' => $especies
    ]);
}

public function listado_especies_invitado(Request $request)
{

    $query = Especie::with(['taxonomia', 'imagenes', 'habitats', 'ubicaciones'])
                    ->where('estado', 'aprobada');

    if ($request->has('tipo') && in_array($request->tipo, ['flora', 'fauna'])) {
        $query->where('tipo', $request->tipo);
    }

    if ($request->has('familia')) {
        $query->whereHas('taxonomia', function ($q) use ($request) {
            $q->where('familia', $request->familia);
        });
    }

    if ($request->has('ubicacion')) {
        $query->whereHas('ubicaciones', function ($q) use ($request) {
            $q->where('ubicacion_id', $request->ubicacion);
        });
    }

    if ($request->has('habitat')) {
        $query->whereHas('habitats', function ($q) use ($request) {
            $q->where('habitat_id', $request->habitat);
        });
    }

    if ($request->has('buscar') && ! empty($request->buscar)) {
        $termino = $request->buscar;
        $query->where(function ($q) use ($termino) {
            $q->where('nombre_cientifico', 'LIKE', "%{$termino}%")
              ->orWhere('nombre_vernaculo',   'LIKE', "%{$termino}%")
              ->orWhere('descripcion',        'LIKE', "%{$termino}%");
        });
    }

    $especies = $query->orderBy('id')->paginate(8)->withQueryString();

   
    $especies->getCollection()->transform(function ($especie) {
        $imagenPrincipal = $especie->imagenes->where('es_principal', true)->first()
                          ?? $especie->imagenes->first();

        $especie->imagen_url = $imagenPrincipal
            ? url($imagenPrincipal->ruta)
            : url('img/especies/' . $especie->tipo . '/default.jpg');

        return $especie;
    });

    
    return response()->json([
        'especies' => $especies
    ]);
}

public function store(Request $request)
{
    try {

      
        
        // Validación de los campos
        $request->validate([
            'tipo' => 'required|string|in:flora,fauna',
            'nombre_cientifico' => 'required|string|max:255',
            'nombre_vernaculo' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'taxonomia_id' => 'required|exists:taxonomias,id',
            'habitats' => 'array',
            'habitats.*' => 'exists:habitats,id',
            'ubicaciones' => 'array',
            'ubicaciones.*' => 'exists:ubicaciones,id',
            'es_principal' => 'array',
            'es_principal.*' => 'in:0,1',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generar el slug basado en el nombre vernacular
        $slug = Str::slug($request->nombre_vernaculo);

        // Verificar si ya existe una especie con el mismo slug
        $existingEspecie = Especie::where('slug', $slug)->first();

        if ($existingEspecie) {
            return response()->json([
                'status' => false,
                'message' => 'Ya existe una especie con el nombre científico proporcionado.'
            ], 400);
        }

        // Crear la especie
        $especie = Especie::create([
            'tipo' => $request->tipo,
            'nombre_cientifico' => $request->nombre_cientifico,
            'nombre_vernaculo' => $request->nombre_vernaculo,
            'descripcion' => $request->descripcion,
            'taxonomia_id' => $request->taxonomia_id,
            'slug' => $slug,
            'estado' => $request->estado ?? 'pendiente',
            'alumno_id' => Auth::id(), // Obtener el ID del usuario logueado
        ]);

   

        // Relacionar hábitats y ubicaciones
        if ($request->has('habitats')) {
            $especie->habitats()->attach($request->habitats);
        }

        if ($request->has('ubicaciones')) {
            $especie->ubicaciones()->attach($request->ubicaciones);
        }

        // Subir imagen si se envía
        if ($request->hasFile('imagen')) {
            $ruta = 'img/especies/';
            $nombreArchivo = $slug . '.' . $request->imagen->getClientOriginalExtension();
            $request->imagen->move(public_path($ruta), $nombreArchivo);

            // Relacionar imagen con la especie
            $especie->imagenes()->create([
                'ruta' => $ruta . $nombreArchivo,
                'es_principal' => 1,
            ]);
        }
        $user = Auth::user();
        error_log(print_r($user, true));  // Esto enviará los detalles del usuario al archivo de log
        

        return response()->json([
            'status' => true,
            'message' => 'Especie registrada correctamente.',
            'especie' => $especie,
        ], 201);

    } catch (\Exception $e) {
        // Capturar el error
        Log::error('Error al registrar especie: ' . $e->getMessage(), [
            'error' => $e->getMessage(),
            'input' => $request->all()
        ]);

        return response()->json([
            'status' => false,
            'message' => '¡Error! Ha ocurrido un error al guardar la especie. Por favor, inténtalo de nuevo.',
            'error' => $e->getMessage(),
        ], 500);
    }
}



    public function show(Request $request, $slug)
    {
        $especie = Especie::with([
            'taxonomia',
            'imagenes',
            'habitats',
            'ubicaciones',
            'comentarios' => function ($q) {
                $q->with('alumno:id,nombre,apellidos,codigo_usuario');
            },
        ])->where('slug', $slug)->first();

        if (! $especie) {
            return response()->json(['message' => 'Especie no encontrada'], 404);
        }

        $user = $request->user();
        if ((! $user || $user->rol === 'alumno') && $especie->estado !== 'aprobada') {
            return response()->json(['message' => 'Especie no encontrada'], 404);
        }

        $especie->imagenes->transform(function ($imagen) {
            $imagen->ruta = url($imagen->ruta);
            return $imagen;
        });

        $imagenPrincipal = $especie->imagenes->where('es_principal', true)->first();
        $especie->imagen_url = $imagenPrincipal
            ? $imagenPrincipal->ruta
            : ($especie->imagenes->first()
                ? $especie->imagenes->first()->ruta
                : url('img/especies/' . $especie->tipo . '/default.jpg'));

        return response()->json($especie);
    }

    public function filtros(Request $request)
    {
        $tipo = $request->tipo ?? null;

        $queryBase = Especie::query();
        $user      = $request->user();

        if (! $user || $user->rol === 'alumno') {
            $queryBase->where('estado', 'aprobada');
        }

        if ($tipo && in_array($tipo, ['flora', 'fauna'])) {
            $queryBase->where('tipo', $tipo);
        }

        $especiesIds = $queryBase->pluck('id')->toArray();

        $familias = Taxonomia::whereHas('especies', function ($q) use ($especiesIds) {
            $q->whereIn('especies.id', $especiesIds);
        })
            ->select('familia')
            ->distinct()
            ->orderBy('familia')
            ->pluck('familia');

        $ubicaciones = Ubicacion::whereHas('especies', function ($q) use ($especiesIds) {
            $q->whereIn('especies.id', $especiesIds);
        })
            ->select('id', 'nombre')
            ->orderBy('nombre')
            ->get();

        $habitats = Habitat::whereHas('especies', function ($q) use ($especiesIds) {
            $q->whereIn('especies.id', $especiesIds);
        })
            ->select('id', 'nombre')
            ->orderBy('nombre')
            ->get();

        return response()->json([
            'familias'    => $familias,
            'ubicaciones' => $ubicaciones,
            'habitats'    => $habitats,
        ]);
    }
}
