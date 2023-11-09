<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registrarPokemon', [PokemonController::class, 'registrarPokemon']);
Route::post('actualizarPoke',[PokemonController::class, 'actualizarPokemon']);
Route::get('listarPoke',[PokemonController::class, 'listarPokemones']);
Route::get('pokemonesAll',[PokemonController::class, 'listarPokemones']);
Route::get('eliminarPoke',[PokemonController::class, 'EliminarPokemon']);
Route::get('cargarPokes',[PokemonController::class, 'CargarPokemon']);



