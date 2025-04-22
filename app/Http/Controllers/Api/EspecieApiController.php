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

class EspecieApiController extends Controller
{

    public function index(Request $request)
{
    $user = $request->user();

    // ——— Si el usuario no está autenticado, se llama al método listado_especies_invitado ———
    if (!$user) {
        return $this->listado_especies_invitado($request);
    }

    // ——— Construcción de la query con relaciones ———
    $query = Especie::with(['taxonomia', 'imagenes', 'habitats', 'ubicaciones']);

    // ——— Filtros opcionales ———
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

    // ——— Filtro de Rol ———
    // Si el usuario no está autenticado o no es 'profesor' ni 'admin', solo se mostrarán especies 'aprobadas'.
    if (!$user || ! in_array($user->rol, ['profesor', 'admin'])) {
        $query->where('estado', 'aprobada');
    }

    // ——— Paginación ———
    $especies = $query->orderBy('id')->paginate(8)->withQueryString();

    // ——— Transformación para incluir imagen principal ———
    $especies->getCollection()->transform(function ($especie) {
        // Obtener imagen principal o la primera imagen disponible
        $imagenPrincipal = $especie->imagenes->where('es_principal', true)->first()
                          ?? $especie->imagenes->first();

        // Asignar URL de la imagen (o por defecto si no hay imagen)
        $especie->imagen_url = $imagenPrincipal
            ? url($imagenPrincipal->ruta)
            : url('img/especies/' . $especie->tipo . '/default.jpg');

        return $especie;
    });

    // ——— Respuesta JSON con depuración ———
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
    // ——— Consultar las especies solo con estado 'aprobada' para usuarios invitados ———
    $query = Especie::with(['taxonomia', 'imagenes', 'habitats', 'ubicaciones'])
                    ->where('estado', 'aprobada');

    // ——— Aplicar filtros (igual que en el método index) ———
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

    // ——— Paginación ———
    $especies = $query->orderBy('id')->paginate(8)->withQueryString();

    // ——— Transformación para incluir imagen principal ———
    $especies->getCollection()->transform(function ($especie) {
        $imagenPrincipal = $especie->imagenes->where('es_principal', true)->first()
                          ?? $especie->imagenes->first();

        $especie->imagen_url = $imagenPrincipal
            ? url($imagenPrincipal->ruta)
            : url('img/especies/' . $especie->tipo . '/default.jpg');

        return $especie;
    });

    // ——— Respuesta JSON para invitados ———
    return response()->json([
        'especies' => $especies
    ]);
}


    public function index1(Request $request)
    {
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
                    ->orWhere('nombre_vernaculo', 'LIKE', "%{$termino}%")
                    ->orWhere('descripcion', 'LIKE', "%{$termino}%");
            });
        }

        $user = $request->user();
        if (! $user || $user->rol === 'alumno') {
            $query->where('estado', 'aprobada');
        }

        $especies = $query->paginate(8);

        $especies->getCollection()->transform(function ($especie) {
            $imagenPrincipal = $especie->imagenes->where('es_principal', true)->first();

            if ($imagenPrincipal) {
                $especie->imagen_url = url($imagenPrincipal->ruta);
            } else {
                $imagenPrincipal     = $especie->imagenes->first();
                $especie->imagen_url = $imagenPrincipal
                    ? url($imagenPrincipal->ruta)
                    : url('img/especies/' . $especie->tipo . '/default.jpg');
            }

            return $especie;
        });


        return response()->json($especies);
    }



public function store(Request $request)
{
    try {
        // Validación
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

        $slug = Str::slug($request->nombre_cientifico);
        $alumno_id = $request->alumno_id ?? 1;

        // Crear especie
        $especie = Especie::create([
            'tipo' => $request->tipo,
            'nombre_cientifico' => $request->nombre_cientifico,
            'nombre_vernaculo' => $request->nombre_vernaculo,
            'descripcion' => $request->descripcion,
            'taxonomia_id' => $request->taxonomia_id,
            'slug' => $slug,
            'estado' => $request->estado ?? 'pendiente',
            'alumno_id' => $alumno_id,
        ]);

        // Relacionar hábitats y ubicaciones
        if ($request->has('habitats')) {
            $especie->habitats()->attach($request->habitats);
        }
        if ($request->has('ubicaciones')) {
            $especie->ubicaciones()->attach($request->ubicaciones);
        }

        // Guardar imagen si se envía
        if ($request->hasFile('imagen')) {
            $tipo = $request->tipo;
            $ruta = "img/especies/{$tipo}/";
            $nombreArchivo = $slug . '.' . $request->imagen->getClientOriginalExtension();
            $request->imagen->move(public_path($ruta), $nombreArchivo);

            $especie->imagenes()->create([
                'ruta' => $ruta . $nombreArchivo,
                'es_principal' => 1,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Especie registrada correctamente con imagen (si fue enviada)',
            'especie' => $especie
        ], 201);
        
    } catch (\Exception $e) {
        Log::error('Error al registrar especie: ' . $e->getMessage(), [
            'error' => $e,
            'input' => $request->all()
        ]);

        return response()->json([
            'status' => false,
            'message' => 'Ocurrió un error al registrar la especie.',
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

<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Especie;
use App\Models\Habitat;
use App\Models\Taxonomia;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class EspecieApiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
    
        // ——— Construcción de la query con relaciones ———
        $query = Especie::with(['taxonomia', 'imagenes', 'habitats', 'ubicaciones']);
    
        // ——— Filtros opcionales ———
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
    
        // ——— Filtro por rol INVERTIDO ———
        // Sólo a alumnos o invitados (no-profesor/admin) se les aplica estado = 'aprobada'
        if (! $user || ! in_array($user->rol, ['profesor', 'admin'])) {
            $query->where('estado', 'aprobada');
        }
        // Profesor y Admin verán todas las especies (aprobada, pendiente, modificada, rechazada…)
    
        // ——— Paginación ———
        $especies = $query->orderBy('id')->paginate(25)->withQueryString();
    
        // ——— Transformación para incluir imagen principal ———
        $especies->getCollection()->transform(function ($especie) {
            $imagenPrincipal = $especie->imagenes->where('es_principal', true)->first()
                              ?? $especie->imagenes->first();
    
            $especie->imagen_url = $imagenPrincipal
                ? url($imagenPrincipal->ruta)
                : url('img/especies/' . $especie->tipo . '/default.jpg');
    
            return $especie;
        });
    
        // ——— Respuesta JSON con debug + datos ———
        return response()->json([
            'debug'    => [
                'is_guest' => is_null($user),
                'user_id'  => optional($user)->id,
                'rol'      => optional($user)->rol,
            ],
            'especies' => $especies
        ]);
    }
    
    
    
    public function show(Request $request, $slug)
    {
        $user = $request->user();
    
        // ——— Búsqueda de la especie con relaciones ———
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
            return response()->json([
                'debug' => [
                    'is_guest' => is_null($user),
                    'user_id'  => optional($user)->id,
                    'rol'      => optional($user)->rol,
                ],
                'mensaje' => 'Especie no encontrada'
            ], 404);
        }
    
        // ——— Filtro por rol INVERTIDO ———
        if (! $user || ! in_array($user->rol, ['profesor', 'admin'])) {
            if ($especie->estado !== 'aprobada') {
                return response()->json([
                    'debug' => [
                        'is_guest' => is_null($user),
                        'user_id'  => optional($user)->id,
                        'rol'      => optional($user)->rol,
                    ],
                    'mensaje' => 'No autorizado para ver esta especie'
                ], 403);
            }
        }
    
        // ——— Transformar rutas de imágenes ———
        $especie->imagenes->transform(function ($imagen) {
            $imagen->ruta = url($imagen->ruta);
            return $imagen;
        });
    
        // ——— Seleccionar imagen principal o por defecto ———
        $imagenPrincipal = $especie->imagenes->where('es_principal', true)->first();
        $especie->imagen_url = $imagenPrincipal
            ? $imagenPrincipal->ruta
            : ($especie->imagenes->first()
                ? $especie->imagenes->first()->ruta
                : url('img/especies/' . $especie->tipo . '/default.jpg'));
    
        // ——— Respuesta JSON con debug + datos ———
        return response()->json([
            'debug'   => [
                'is_guest' => is_null($user),
                'user_id'  => optional($user)->id,
                'rol'      => optional($user)->rol,
            ],
            'especie' => $especie
        ]);
    }
    

    
    public function filtros(Request $request)
    {
        $tipo = $request->tipo ?? null;
        $queryBase = Especie::query();
        $user = $request->user();
        
    
        // ——— Filtro por rol INVERTIDO ———
        // Sólo alumnos o invitados (no-profesor/admin) verán solo las aprobadas
        if (! $user || ! in_array($user->rol, ['profesor', 'admin'])) {
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
    
        // ——— Respuesta JSON con debug + datos ——— 
        return response()->json([
            'debug' => [
                'is_guest' => is_null($user),
                'user_id'  => optional($user)->id,
                'rol'      => optional($user)->rol,
            ],
            'filtros' => [
                'familias'    => $familias,
                'ubicaciones' => $ubicaciones,
                'habitats'    => $habitats,
            ],
        ]);
    }
}