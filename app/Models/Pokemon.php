<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;
    protected $table = 'pokemon';

    protected $fillable =[
        'nombre'
    ];

    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function tipo_uno(){
        return $this->belongsTo(TipoPokemon::class, 'tipo_uno_id');
    }
    public function tipo_dos(){
        return $this->belongsTo(TipoPokemon::class, 'tipo_dos_id');
    }
    public function pokedex(){
        return $this->hasMany(Pokedex::class);
    }
}
