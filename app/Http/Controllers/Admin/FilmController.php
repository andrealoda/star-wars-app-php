<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use App\Models\Person;

use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        $film = new Film();
        $people = Person::orderBy('nome')->get();
        return view('admin.films.create', compact('film', 'people'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titolo' => 'required|string|max:255',
            'episodio' => 'nullable|integer|min:1',
            'data_uscita' => 'nullable|date',
            'regista' => 'nullable|string|max:255',
            'sinossi' => 'nullable|string',

            'people_ids' => 'nullable|array',
            'people_ids.*' => 'exists:people,id',

            'immagine' => 'nullable|image|max:2048',
        ]);

        $newFilm = new Film();
        $newFilm->titolo = $data['titolo'];
        $newFilm->episodio = $data['episodio'] ?? null;
        $newFilm->data_uscita = $data['data_uscita'] ?? null;
        $newFilm->regista = $data['regista'] ?? null;
        $newFilm->sinossi = $data['sinossi'] ?? null;

        if ($request->hasFile('immagine')) {
            // scriviamo il file nella cartella public/films
            $newFilm->immagine = $request->file('immagine')->store('films', 'public');
        }

        $newFilm->save();

        $newFilm->people()->sync($data['people_ids'] ?? []);

        return redirect()->route('admin.films.show', $newFilm)->with('success', 'Film creato con successo.');
    }

    public function show(Film $film)
    {
        return view('admin.films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        $people = Person::orderBy('nome')->get();
        return view('admin.films.edit', compact('film', 'people'));
    }

    public function update(Request $request, Film $film)
    {
        $data = $request->validate([
            'titolo' => 'required|string|max:255',
            'episodio' => 'nullable|integer|min:1',
            'data_uscita' => 'nullable|date',
            'regista' => 'nullable|string|max:255',
            'sinossi' => 'nullable|string',

            'people_ids' => 'nullable|array',
            'people_ids.*' => 'exists:people,id',

            'immagine' => 'nullable|image|max:2048',
        ]);

        $film->titolo = $data['titolo'];
        $film->episodio = $data['episodio'] ?? null;
        $film->data_uscita = $data['data_uscita'] ?? null;
        $film->regista = $data['regista'] ?? null;
        $film->sinossi = $data['sinossi'] ?? null;

        if ($request->hasFile('immagine')) {
            if ($film->immagine) {
                // cancelliamo il vecchio file
                Storage::disk('public')->delete($film->immagine);
            }
            // scriviamo il nuovo file nella cartella public/films
            $film->immagine = $request->file('immagine')->store('films', 'public');
        }


        $film->save();

        $film->people()->sync($data['people_ids'] ?? []);

        return redirect()->route('admin.films.show', $film)->with('success', 'Film aggiornato con successo.');
    }

    public function destroy(Film $film)
    {
        if ($film->immagine) {
            Storage::disk('public')->delete($film->immagine);
        }

        $film->delete();
        return redirect()->route('admin.films.index')->with('success', 'Film eliminato con successo.');
    }
}
