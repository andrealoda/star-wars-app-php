<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/people.json');
        $people = json_decode(file_get_contents($path), true);

        foreach ($people as $person) {
            $newPerson = new Person();
            $newPerson->id = $this->idFromUrl($person['url']);
            $newPerson->nome = $person['name'];
            $newPerson->altezza = is_numeric($person['height']) ? (int) $person['height'] : null;
            $newPerson->peso = is_numeric($person['mass']) ? (int) $person['mass'] : null;
            $newPerson->colore_capelli = !in_array($person['hair_color'], ['n/d', 'nessuno']) ? $person['hair_color'] : null;
            $newPerson->colore_occhi = $person['eye_color'] !== 'sconosciuto' ? $person['eye_color'] : null;
            $newPerson->anno_nascita = $person['birth_year'] !== 'sconosciuto' ? $person['birth_year'] : null;
            $newPerson->genere = !in_array($person['gender'], ['n/d', 'nessuno']) ? $person['gender'] : null;

            $newPerson->planet_id = $this->idFromUrl($person['homeworld'] ?? null);
            $newPerson->species_id = ! empty($person['species']) ? $this->idFromUrl($person['species'][0]) : null;

            $newPerson->save();
        }
    }

    private function idFromUrl(?string $url): ?int
    {
        return $url ? (int) basename(rtrim($url, '/')) : null;
    }
}