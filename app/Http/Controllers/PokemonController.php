<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function hola(PokemonRequest $request){
        if($request->despide == "si"|| $request->despide== "no"){
            return "chao";
        }
    }
}
