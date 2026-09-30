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

        foreach ($species as $specie) {
            $newSpecie = new Species();
            $newSpecie->id = $this->idFromUrl($specie['url']);
            $newSpecie->nome = $specie['name'];
            $newSpecie->lingua = !in_array($specie['language'], ['sconosciuto', 'n/d']) ? $specie['language'] : null;
            $newSpecie->save();
        }
    }

    private function idFromUrl(?string $url): ?int
    {
        return $url ? (int) basename(rtrim($url, '/')) : null;
    }
}