<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Film;

class ApiFilmController extends Controller
{
    public function index()
    {
        $films = Film::with('people')->get();
        return response()->json([
            'success' => true,
            'results' => $films,
        ]);
    }

    public function show($id)
    {
        $film = Film::with('people')->findOrFail($id);
        return response()->json([
            'success' => true,
            'results' => $film,
        ]);
    }
}
