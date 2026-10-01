<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Person;
use App\Models\Planet;
use App\Models\Species;

use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = Person::all();
        return view('admin.people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $person = new Person();

        $planets = Planet::orderBy('nome')->get();
        $species = Species::orderBy('nome')->get();

        return view('admin.people.create', compact('person', 'planets', 'species'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'altezza' => 'nullable|integer|min:0',
            'peso' => 'nullable|integer|min:0',
            'colore_capelli' => 'nullable|string|max:255',
            'colore_occhi' => 'nullable|string|max:255',
            'anno_nascita' => 'nullable|string|min:0',
            'genere' => 'nullable|string|max:255',

            'planet_id' => 'nullable|exists:planets,id',
            'species_id' => 'nullable|exists:species,id',

            'immagine' => 'nullable|image|max:2048',
        ]);

        $newPerson = new Person();
        $newPerson->nome = $data['nome'];
        $newPerson->altezza = $data['altezza'] ?? null;
        $newPerson->peso = $data['peso'] ?? null;
        $newPerson->colore_capelli = $data['colore_capelli'] ?? null;
        $newPerson->colore_occhi = $data['colore_occhi'] ?? null;
        $newPerson->anno_nascita = $data['anno_nascita'] ?? null;
        $newPerson->genere = $data['genere'] ?? null;

        $newPerson->planet_id = $data['planet_id'] ?? null;
        $newPerson->species_id = $data['species_id'] ?? null;

        if ($request->hasFile('immagine')) {
            // scriviamo il file nella cartella public/people
            $newPerson->immagine = $request->file('immagine')->store('people', 'public');
        }

        $newPerson->save();

        return redirect()->route('admin.people.show', $newPerson)->with('success', 'Personaggio creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return view('admin.people.show', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        $planets = Planet::orderBy('nome')->get();
        $species = Species::orderBy('nome')->get();
        return view('admin.people.edit', compact('person', 'planets', 'species'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'altezza' => 'nullable|integer|min:0',
            'peso' => 'nullable|integer|min:0',
            'colore_capelli' => 'nullable|string|max:255',
            'colore_occhi' => 'nullable|string|max:255',
            'anno_nascita' => 'nullable|string|min:0',
            'genere' => 'nullable|string|max:255',

            'planet_id' => 'nullable|exists:planets,id',
            'species_id' => 'nullable|exists:species,id',

            'immagine' => 'nullable|image|max:2048',
        ]);

        $person->nome = $data['nome'];
        $person->altezza = $data['altezza'] ?? null;
        $person->peso = $data['peso'] ?? null;
        $person->colore_capelli = $data['colore_capelli'] ?? null;
        $person->colore_occhi = $data['colore_occhi'] ?? null;
        $person->anno_nascita = $data['anno_nascita'] ?? null;
        $person->genere = $data['genere'] ?? null;

        $person->planet_id = $data['planet_id'] ?? null;
        $person->species_id = $data['species_id'] ?? null;

        if ($request->hasFile('immagine')) {
            if ($person->immagine) {
                // cancelliamo il vecchio file
                Storage::disk('public')->delete($person->immagine);
            }
            // scriviamo il nuovo file nella cartella public/people
            $person->immagine = $request->file('immagine')->store('people', 'public');
        }

        $person->save();

        return redirect()->route('admin.people.show', $person)->with('success', 'Personaggio aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        if ($person->immagine) {
            Storage::disk('public')->delete($person->immagine);
        }    

        $person->delete();
        return redirect()->route('admin.people.index')->with('success', 'Personaggio eliminato con successo.');
    }
}
