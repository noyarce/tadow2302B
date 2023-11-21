<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\AuthController;


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signUp']);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);  
    Route::get('pokemonesAll', [PokemonController::class, 'listarPokemones']);
    Route::post('registrarPokedex',[PokemonController::class, 'registrarPokedex']);
    Route::get('random',[PokemonController::class, 'pokeRandom']);

});

Route::group(['prefix' => 'poke'], function () {

    Route::post('registrarPokemon', [PokemonController::class, 'registrarPokemon']);
    Route::post('actualizarPoke', [PokemonController::class, 'actualizarPokemon']);
    Route::get('listarPoke', [PokemonController::class, 'listarPokemones']);
    Route::get('pokemonesAll', [PokemonController::class, 'listarPokemones']);
    Route::get('eliminarPoke', [PokemonController::class, 'EliminarPokemon']);
    Route::get('cargarPokes', [PokemonController::class, 'CargarPokemon']);


});
