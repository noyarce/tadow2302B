<?php

namespace App\Repositories;

use App\Models\Pokemon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PokemonRepository
{
    public function registrarPokemon($request)
    {
        try {
            $pokemon = new Pokemon();
            $pokemon->nombre = $request->nombre;
            $pokemon->save();
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                 "linea"=> $e->getLine(), 
                 "file"=> $e->getFile(),
                 "metodo"=> __METHOD__
        ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function actualizarPokemon($request){
        try{
            $pokemon= Pokemon::findorfail($request->id);
            $pokemon->nombre = $request->nombreNuevo;
            $pokemon->save();
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        }catch(Exception $e){
            Log::info(["error" => $e->getMessage(),
            "linea"=> $e->getLine(), 
            "file"=> $e->getFile(),
            "metodo"=> __METHOD__]);

            return response()->json([
                "error" => $e->getMessage(),
                 "linea"=> $e->getLine(), 
                 "file"=> $e->getFile(),
                 "metodo"=> __METHOD__
        ], Response::HTTP_BAD_REQUEST);
        }
    }
}