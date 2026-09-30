<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/films.json');
        $films = json_decode(file_get_contents($path), true);

        foreach ($films as $film) {
            $newFilm = new Film();
            $newFilm->id = $this->idFromUrl($film['url']);
            $newFilm->titolo = $film['title'];
            $newFilm->episodio = $film['episode_id'];
            $newFilm->data_uscita = $film['release_date'];
            $newFilm->regista = $film['director'];
            $newFilm->sinossi = $film['opening_crawl'];
            $newFilm->save();

            // $film['characters'] è un array di URL;
            // con array_map li trasformo negli ID numerici usando idFromUrl();
            // Poi $newFilm->people()->attach($personIds) inserisce una riga in film_person per ciascun ID

            $personIds = array_map(fn($url) => $this->idFromUrl($url), $film['characters']);
            $newFilm->people()->attach($personIds);
            // per far funzionare "attach", PersonSeeder deve girare prima di FilmSeeder
            // altrimenti ho un errore di vincolo di integrità perchè trova un person_id che ancora non esiste
        }
    }

    private function idFromUrl(?string $url): ?int
    {
        return $url ? (int) basename(rtrim($url, '/')) : null;
    }
}
