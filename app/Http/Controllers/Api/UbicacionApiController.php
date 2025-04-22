<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionApiController extends Controller
{
    public function index(Request $request)
    {
        $ubicaciones = Ubicacion::all();
        return response()->json($ubicaciones);
    }
}
