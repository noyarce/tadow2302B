<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
class PokemonController extends Controller
{    
    protected PokemonRepository $pokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository){
        $this->pokemonRepository = $pokemonRepository;
    }
    
    public function hola(PokemonRequest $request){
       return $this->pokemonRepository->registrarPokemon($request);
    }

    public function actualizarPokemon(PokemonRequest $request){
        return $this->pokemonRepository->actualizarPokemon($request);
     }
}
