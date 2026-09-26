<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/species.json');
        $species = json_decode(file_get_contents($path), true);

        foreach ($species as $sp) {
            $newSp = new Species();
            $newSp->id = $this->idFromUrl($sp['url']);
            $newSp->nome = $sp['name'];
            $newSp->classificazione = $sp['classification'] !== 'unknown' ? $sp['classification'] : null;
            $newSp->lingua = $sp['language'] !== 'unknown' ? $sp['language'] : null;
            $newSp->aspettativa_vita = is_numeric($sp['average_lifespan']) ? $sp['average_lifespan'] : null;
            $newSp->save();
        }
    }

    private function idFromUrl(?string $url): ?int
    {
        return $url ? (int) basename(rtrim($url, '/')) : null;
    }
}