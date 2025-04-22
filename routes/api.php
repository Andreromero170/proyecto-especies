<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EspecieApiController;
use App\Http\Controllers\Api\HabitatApiController;
use App\Http\Controllers\Api\TaxonomiaApiController;
use App\Http\Controllers\Api\UbicacionApiController;
use App\Models\Habitat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas públicas de autenticación
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// Rutas para especies:
// Route::get('/especies', [EspecieApiController::class, 'index']);
Route::get('/listado_especies_invitado', [EspecieApiController::class, 'listado_especies_invitado']);

Route::middleware('auth:sanctum')->get('/especies', [EspecieApiController::class, 'index']);

Route::post('/especies', [EspecieApiController::class, 'store']);
// Route::get('/especies/filtros', [EspecieApiController::class, 'filtros']);
// Route::get('/especies/{slug}', [EspecieApiController::class, 'show']);



// Rutas para taxonomias
Route::get('/taxonomias', [TaxonomiaApiController::class, 'index']); 

// Rutas para Habitats
Route::get('/habitats', [HabitatApiController::class, 'index']); 

// Rutas para Ubicacion
Route::get('/ubicaciones', [UbicacionApiController::class, 'index']); 

// Rutas protegidas:
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
