<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hola', [PokemonController::class, 'hola']);
Route::post('actualizarPoke',[PokemonController::class, 'actualizarPokemon']);

