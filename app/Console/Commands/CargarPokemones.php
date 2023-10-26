<?php

namespace App\Console\Commands;

use App\Repositories\PokemonRepository;
use Illuminate\Console\Command;

class CargarPokemones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cargarPokemones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'comando que usamos para cargar pokemones en la bd';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $repo= new PokemonRepository();
        $repo->cargarPokemones();
    }
}
