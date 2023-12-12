<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
{
    use HasFactory;
    protected $table = "pokedexes";

    public function pokemon(){
        return $this->belongsTo(Pokemon::class, 'pokemon_id');
    }
}
