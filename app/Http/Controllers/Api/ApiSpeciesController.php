<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Species;

class ApiSpeciesController extends Controller
{
    public function index()
    {
        $species = Species::with('people')->get();

        return response()->json([
            'success' => true,
            'results' => $species,
        ]);
    }

    public function show($id)
    {
        $specie = Species::with('people')->findOrFail($id);

        return response()->json([
            'success' => true,
            'results' => $specie,
        ]);
    }
}