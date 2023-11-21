<?php

namespace App\Repositories;

use App\Jobs\CargaPokemonesJob;
use App\Models\Pokedex;
use App\Models\Pokemon;
use App\Models\Region;
use App\Models\TipoPokemon;
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
          
           if(isset($request->limit)){
            $pokemon = Pokemon::with(['region:id,reg_nombre','tipo_uno','tipo_dos'])
           ->orderBy('num_pokedex','ASC')
           ->take($request->limit)
           ->get();
           }else{ 
            $pokemon = Pokemon::with(['region:id,reg_nombre','tipo_uno','tipo_dos'])
           ->orderBy('num_pokedex','ASC')
           ->get();
            }
            // $pokemon = Pokemon::where('nombre', 'like', '%'.$request->nombre.'%')
            // ->with(['region:id,reg_nombre','tipo_uno','tipo_dos'])->get();

           // $pokemon= Pokemon::where('num_pokedex', $request->num_pokedex)->get();
            
           // $pokemon = Pokemon::whereHas('region', function($q) use($request){
           //     $q->where('reg_nombre',$request->region);
           // })
           // ->with('region:id,reg_nombre')
           // 
           // ->get();
//
           // $pokemon= Pokemon::when(isset($request->num_pokedex), function($q) use ($request) {
           //     $q->where('num_pokedex',$request->num_pokedex);
           // })
           // ->when(isset($request->nombre), function ($q2) use ($request){
           //     $q2->where('nombre', 'like', '%'.$request->nombre.'%');
           // })
           // ->get();

            //$pokemon = Pokemon::join('regions', 'regions.id', '=','pokemon.region_id')
            //            ->where('reg_nombre',$request->region)
            //            ->get();

            //$pokemon = Pokemon::whereHas('tipo_uno', function ($q) use($request){
            //    $q->where('tip_nombre', $request->tipo);
            //})
            //->orwherehas('tipo_dos', function($q2) use($request){
            //    $q2->where('tip_nombre', $request->tipo);
            //})->with(['region:id,reg_nombre','tipo_uno','tipo_dos'])->get();
            
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
              //$this->cargaPokemonPorRegion($i);
             CargaPokemonesJob::dispatch($i);
            }

            return response()->json(["ok"], Response::HTTP_OK);
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

    public function cargaPokemonPorRegion($id)
    {
        $pokemonServiceRegion = new PokemonService;
        $pokemones = $pokemonServiceRegion->CargarRegiones($id);
        $region = new Region();
        $region->reg_nombre = $pokemones['body']['main_region']['name'];
        $region->save();
        foreach ($pokemones['body']['pokemon_species'] as $pokemon) {

            Log::info(["pokemon a revisar "=> $pokemon]);

            // $pokemon['url'] equivale a : 'https://pokeapi.co/api/v2/pokemon-species/???/'
            $idPokedex = str_replace('https://pokeapi.co/api/v2/pokemon-species/','', $pokemon['url']);
            // $idPokedex -> ???/

            $idPokedex= str_replace('/','', $idPokedex);
            // $idPokedex -> ??? 
            $pokemonServiceTipo = new PokemonService;
            $pokemonTipo = $pokemonServiceTipo->CargarPokemonIndividual($idPokedex);

            Log::info([" poke x tipo"=> $pokemonTipo['body']['types'][0]['type']['name']]);
         
            $tipoUno = TipoPokemon::where('tip_nombre', $pokemonTipo['body']['types'][0]['type']['name'])->first();
            if(!$tipoUno){
                $tipoUno = new TipoPokemon();
                $tipoUno->tip_nombre = $pokemonTipo['body']['types'][0]['type']['name'];
                $tipoUno->save();
            }
            if(isset($pokemonTipo['body']['types'][1])){
                Log::info([" poke x tipo"=> $pokemonTipo['body']['types'][1]['type']['name']]);

                $tipoDos = TipoPokemon::where('tip_nombre', $pokemonTipo['body']['types'][1]['type']['name'])->first();
                if(!$tipoDos){
                    $tipoDos = new TipoPokemon();
                    $tipoDos->tip_nombre = $pokemonTipo['body']['types'][1]['type']['name'];
                    $tipoDos->save();
                }
            }

            $poke = new Pokemon();
            $poke->nombre = $pokemon['name'];
            $poke->region_id = $region->id;
            $poke->tipo_uno_id =$tipoUno->id;
            $poke->tipo_dos_id = isset($pokemonTipo['body']['types'][1]) ? $tipoDos->id : null;
            $poke->num_pokedex = (int)$idPokedex;
            $poke->save();
        }
    }


    public function registrarPokedex($request){
        try {
           $pokemon = new Pokedex();
           $pokemon->pokemon_id = $request->pokemon_id;
           $pokemon->usuario_id = $request->usuario_id;

            return response()->json(["ok"], Response::HTTP_OK);
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

    public function random($request){
        try {
            Log::info(["request"=> $request->user()]);
           $pokemon= Pokemon::with(['region', 'tipo_uno', 'tipo_dos'])->inRandomOrder()->first(); 
             return response()->json(["pokemon"=> $pokemon], Response::HTTP_OK);
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
