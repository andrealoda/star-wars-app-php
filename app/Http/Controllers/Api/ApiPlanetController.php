<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planet;

class ApiPlanetController extends Controller
{
    public function index()
    {
        $planets = Planet::with('people')->get();

        return response()->json([
            'success' => true,
            'results' => $planets,
        ]);
    }

    public function show($id)
    {
        $planet = Planet::with('people')->findOrFail($id);

        return response()->json([
            'success' => true,
            'results' => $planet,
        ]);
    }
}