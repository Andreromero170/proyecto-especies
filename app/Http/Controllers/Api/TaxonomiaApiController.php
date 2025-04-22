<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taxonomia;
use Illuminate\Http\JsonResponse;

class TaxonomiaApiController extends Controller
{
    public function index(): JsonResponse
    {
        $taxonomias = Taxonomia::all();
        return response()->json($taxonomias);
    }
}
