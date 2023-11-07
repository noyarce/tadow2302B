<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ListarPokeRequest,PokemonRequest };
use App\Repositories\PokemonRepository;
use Illuminate\Http\Request;

class PokemonController extends Controller
{    
    protected PokemonRepository $pokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository){
        $this->pokemonRepository = $pokemonRepository;
    }
    
    public function registrarPokemon(PokemonRequest $request){
       return $this->pokemonRepository->registrarPokemon($request);
    }

    public function actualizarPokemon(PokemonRequest $request){
        return $this->pokemonRepository->actualizarPokemon($request);
     }

     public function listarPokemones(Request $request){
        return $this->pokemonRepository->listarPokemones($request);
     }

     public function EliminarPokemon(ListarPokeRequest $request){
        return $this->pokemonRepository->eliminarPokemon($request);
     }

     public function CargarPokemon(){
      return $this->pokemonRepository->cargarPokemones();
     }
}

