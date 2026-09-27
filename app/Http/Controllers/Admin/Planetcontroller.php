<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planet;
use Illuminate\Http\Request;

class PlanetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planets = Planet::all();
        return view('admin.planets.index', compact('planets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $planet = new Planet();
        return view('admin.planets.create', compact('planet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'clima' => 'nullable|string|max:255',
            'terreno' => 'nullable|string|max:255',
            'popolazione' => 'nullable|integer|min:0',
        ]);

        $newPlanet = new Planet();
        $newPlanet->nome = $data['nome'];
        $newPlanet->clima = $data['clima'] ?? null;
        $newPlanet->terreno = $data['terreno'] ?? null;
        $newPlanet->popolazione = $data['popolazione'] ?? null;

        $newPlanet->save();

        return redirect()->route('admin.planets.show', $newPlanet)->with('success', 'Pianeta creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Planet $planet)
    {
        return view('admin.planets.show', compact('planet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Planet $planet)
    {
        return view('admin.planets.edit', compact('planet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Planet $planet)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'clima' => 'nullable|string|max:255',
            'terreno' => 'nullable|string|max:255',
            'popolazione' => 'nullable|integer|min:0',
        ]);

        $planet->nome = $data['nome'];
        $planet->clima = $data['clima'] ?? null;
        $planet->terreno = $data['terreno'] ?? null;
        $planet->popolazione = $data['popolazione'] ?? null;
        $planet->save();

        return redirect()->route('admin.planets.show', $planet)->with('success', 'Pianeta aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Planet $planet)
    {
        $planet->delete();
        return redirect()->route('admin.planets.index')->with('success', 'Pianeta eliminato con successo.');
    }
}
