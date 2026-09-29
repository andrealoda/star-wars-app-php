<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

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
        return view('admin.films.create', compact('film'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titolo' => 'required|string|max:255',
            'episodio' => 'nullable|integer|min:1',
            'data_uscita' => 'nullable|date',
            'regista' => 'nullable|string|max:255',
            'sinossi' => 'nullable|string',
        ]);

        $newFilm = new Film();
        $newFilm->titolo = $data['titolo'];
        $newFilm->episodio = $data['episodio'] ?? null;
        $newFilm->data_uscita = $data['data_uscita'] ?? null;
        $newFilm->regista = $data['regista'] ?? null;
        $newFilm->sinossi = $data['sinossi'] ?? null;
        $newFilm->save();

        return redirect()->route('admin.films.show', $newFilm)->with('success', 'Film creato con successo.');
    }

    public function show(Film $film)
    {
        return view('admin.films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        return view('admin.films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $data = $request->validate([
            'titolo' => 'required|string|max:255',
            'episodio' => 'nullable|integer|min:1',
            'data_uscita' => 'nullable|date',
            'regista' => 'nullable|string|max:255',
            'sinossi' => 'nullable|string',
        ]);

        $film->titolo = $data['titolo'];
        $film->episodio = $data['episodio'] ?? null;
        $film->data_uscita = $data['data_uscita'] ?? null;
        $film->regista = $data['regista'] ?? null;
        $film->sinossi = $data['sinossi'] ?? null;
        $film->save();

        return redirect()->route('admin.films.show', $film)->with('success', 'Film aggiornato con successo.');
    }

    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('admin.films.index')->with('success', 'Film eliminato con successo.');
    }
}