<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Species;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class SpeciesController extends Controller
{
    public function index()
    {
        $species = Species::all();
        return view('admin.species.index', compact('species'));
    }

    public function create()
    {
        $specie = new Species();
        return view('admin.species.create', compact('specie'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'lingua' => 'nullable|string|max:255',

            'immagine' => 'nullable|image|max:2048',
        ]);

        $newSpecie = new Species();
        $newSpecie->nome = $data['nome'];
        $newSpecie->lingua = $data['lingua'] ?? null;

        if ($request->hasFile('immagine')) {
            // scriviamo il file nella cartella public/species
            $newSpecie->immagine = $request->file('immagine')->store('species', 'public');
        }

        $newSpecie->save();

        return redirect()->route('admin.species.show', $newSpecie)->with('success', 'Specie creata con successo.');
    }

    public function show(Species $specie)
    {
        return view('admin.species.show', compact('specie'));
    }

    public function edit(Species $specie)
    {
        return view('admin.species.edit', compact('specie'));
    }

    public function update(Request $request, Species $specie)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'lingua' => 'nullable|string|max:255',

            'immagine' => 'nullable|image|max:2048',
        ]);

        $specie->nome = $data['nome'];
        $specie->lingua = $data['lingua'] ?? null;

        if ($request->hasFile('immagine')) {
            if ($specie->immagine) {
                // cancelliamo il vecchio file
                Storage::disk('public')->delete($specie->immagine);
            }
            // scriviamo il nuovo file nella cartella public/species
            $specie->immagine = $request->file('immagine')->store('species', 'public');
        }

        $specie->save();

        return redirect()->route('admin.species.show', $specie)->with('success', 'Specie aggiornata con successo.');
    }

    public function destroy(Species $specie)
    {
        if ($specie->immagine) {
            Storage::disk('public')->delete($specie->immagine);
        }

        $specie->delete();
        return redirect()->route('admin.species.index')->with('success', 'Specie eliminata con successo.');
    }
}
