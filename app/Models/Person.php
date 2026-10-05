<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Planet;
use App\Models\Species;

class Person extends Model
{
    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }

    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function films()
    {
        // i film del personaggio, ordinati per numero di episodio
        return $this->belongsToMany(Film::class)->orderBy('episodio');
    }
}
