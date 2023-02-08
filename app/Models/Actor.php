<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $table = "actores";

    public function peliculas(){
        return $this->belongsToMany(Pelicula::class, "peliculas_actores", "pelicula_id");
    }
}
