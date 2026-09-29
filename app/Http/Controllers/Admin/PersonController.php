<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Person;

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
        return view('admin.people.create', compact('person'));
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
        ]);

        $newPerson = new Person();
        $newPerson->nome = $data['nome'];
        $newPerson->altezza = $data['altezza'] ?? null;
        $newPerson->peso = $data['peso'] ?? null;
        $newPerson->colore_capelli = $data['colore_capelli'] ?? null;
        $newPerson->colore_occhi = $data['colore_occhi'] ?? null;
        $newPerson->anno_nascita = $data['anno_nascita'] ?? null;
        $newPerson->genere = $data['genere'] ?? null;

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
        return view('admin.people.edit', compact('person'));
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
        ]);

        $person->nome = $data['nome'];
        $person->altezza = $data['altezza'] ?? null;
        $person->peso = $data['peso'] ?? null;
        $person->colore_capelli = $data['colore_capelli'] ?? null;
        $person->colore_occhi = $data['colore_occhi'] ?? null;
        $person->anno_nascita = $data['anno_nascita'] ?? null;
        $person->genere = $data['genere'] ?? null;

        $person->save();

        return redirect()->route('admin.people.show', $person)->with('success', 'Personaggio aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('admin.people.index')->with('success', 'Personaggio eliminato con successo.');
    }
}
