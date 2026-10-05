<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;

class ApiPersonController extends Controller
{
    public function index()
    {
        $people = Person::with('planet', 'species')->get();

        return response()->json([
            'success' => true,
            'results' => $people,
        ]);
    }

    public function show($id)
    {
        $person = Person::with('planet', 'species', 'films')->findOrFail($id);

        return response()->json([
            'success' => true,
            'results' => $person,
        ]);
    }
}