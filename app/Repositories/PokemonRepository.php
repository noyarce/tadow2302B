<?php

namespace App\Repositories;

use App\Models\Pokemon;
use App\Models\Region;
use App\Services\PokemonService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PokemonRepository
{
    public function registrarPokemon($request)
    {
        try {
            $region = Region::where('reg_nombre', $request->region)->first();

            $pokemon = new Pokemon();
            $pokemon->nombre = $request->nombre;
            $pokemon->region_id = $region->id;
            $pokemon->save();
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function actualizarPokemon($request)
    {
        try {
            $pokemon = Pokemon::find($request->id);
            $pokemon->nombre = $request->nombre;
            $pokemon->save();
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ]);

            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarPokemones($request)
    {
        try {
            $pokemon = Pokemon::whereIn('id', [3, 4, 5, 6, 7])
                ->get();
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ]);

            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function eliminarPokemon($request)
    {
        try {
            $pokemon = Pokemon::find($request->id);
            $pokemon->delete();

            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ]);

            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function cargarPokemones()
    {
        try {           
            for ($i = 1; $i <= 9; $i++) {
                $pokemonServiceRegion = new PokemonService;
                $pokemones = $pokemonServiceRegion->CargarRegiones($i);
                $region = new Region();
                $region->reg_nombre = $pokemones['body']['main_region']['name'];
                $region->save();
                   foreach ($pokemones['body']['pokemon_species'] as $pokemon){
                       $poke = new Pokemon();
                       $poke->nombre = $pokemon['name'];
                       $poke->region_id = $region->id;
                       $poke->save();
                   }
            }




            return response()->json(["pokemon" => $pokemones], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ]);

            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
