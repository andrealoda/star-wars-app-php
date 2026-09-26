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
        }
    }

    private function idFromUrl(?string $url): ?int
    {
        return $url ? (int) basename(rtrim($url, '/')) : null;
    }
}