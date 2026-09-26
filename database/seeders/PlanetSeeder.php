<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Planet;


class PlanetSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/planets.json');
        $planets = json_decode(file_get_contents($path), true);

        foreach ($planets as $planet) {
            $newPlanet = new Planet();
            $newPlanet->id = $this->idFromUrl($planet['url']);
            $newPlanet->nome = $planet['name'];
            $newPlanet->clima = $planet['climate'] !== 'unknown' ? $planet['climate'] : null;
            $newPlanet->terreno = $planet['terrain'] !== 'unknown' ? $planet['terrain'] : null;
            $newPlanet->popolazione = is_numeric($planet['population']) ? $planet['population'] : null;
            
            $newPlanet->save();
        }
    }

    private function idFromUrl(?string $url): ?int
    {
        return $url ? (int) basename(rtrim($url, '/')) : null;
    }
}
