<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function hola(PokemonRequest $request){
        
        $pokemon = new Pokemon();
        $pokemon->nombre = $request->nombre;
        $pokemon->save();

        return $pokemon;
    }
}
