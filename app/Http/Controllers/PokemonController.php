<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function hola(Request $request){
        if($request->despide == "si"|| $request->despide== "no"){
            return "chao";
        }
    }
}
