<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class PokemonService{

    public function cargarPokemones(){
        try{
            $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=100000&offset=0');


            if($response->successful()){
                return ["body"=>$response->json(), "status"=> $response->status()];
            }
            if($response->failed()){
                return ["body"=>"fallo de informacion", "status"=> $response->status()];

            }
            if($response->clientError()){
                return ["body"=>" fallo de comunicacion", "status"=> $response->status()];

            }
        
        
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                 "linea"=> $e->getLine(), 
                 "file"=> $e->getFile(),
                 "metodo"=> __METHOD__
        ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function CargarRegiones($id){
        try{
            $response = Http::get('https://pokeapi.co/api/v2/generation/'.$id);


            if($response->successful()){
                return ["body"=>$response->json(), "status"=> $response->status()];
            }
            if($response->failed()){
                return ["body"=>"fallo de informacion", "status"=> $response->status()];

            }
            if($response->clientError()){
                return ["body"=>" fallo de comunicacion", "status"=> $response->status()];

            }
        
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                 "linea"=> $e->getLine(), 
                 "file"=> $e->getFile(),
                 "metodo"=> __METHOD__
        ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function CargarPokemonIndividual($id){
        try{
            $response = Http::get('https://pokeapi.co/api/v2/pokemon/'.$id);


            if($response->successful()){
                return ["body"=>$response->json(), "status"=> $response->status()];
            }
            if($response->failed()){
                return ["body"=>"fallo de informacion", "status"=> $response->status()];

            }
            if($response->clientError()){
                return ["body"=>" fallo de comunicacion", "status"=> $response->status()];

            }
        
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                 "linea"=> $e->getLine(), 
                 "file"=> $e->getFile(),
                 "metodo"=> __METHOD__
        ], Response::HTTP_BAD_REQUEST);
        }
    }
}


