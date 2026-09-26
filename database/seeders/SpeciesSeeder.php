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
            $newSp->lingua = $sp['language'] !== 'unknown' ? $sp['language'] : null;
            $newSp->save();
        }
    }

    private function idFromUrl(?string $url): ?int
    {
        return $url ? (int) basename(rtrim($url, '/')) : null;
    }
}