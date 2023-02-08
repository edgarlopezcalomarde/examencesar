<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;


    public function director(){
        return $this->belongsTo(Director::class);
    }

    public function actores(){
        return $this->belongsToMany(Actor::class, "peliculas_actores", "pelicula_id","actores_id");
    }
}
