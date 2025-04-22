<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Habitat;
use Illuminate\Http\Request;

class HabitatApiController extends Controller
{
    public function index(Request $request)
    {
        $habitats = Habitat::all();
        return response()->json($habitats);
    }
}
