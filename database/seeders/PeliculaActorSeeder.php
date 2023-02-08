<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Pelicula;
use App\Models\PeliculaActor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeliculaActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peliculas = Pelicula::all();
        $peliculas->each( function($peli){
            $actores = Actor::all()->toArray();
            shuffle($actores);
            $random=random_int(1,3);

            for ($i = 1; $i <= $random; $i++) {

                PeliculaActor::create([
                    'pelicula_id' => $peli->id,
                    'actores_id'=> $actores[$i]['id']
                ]);
            }
        });
    }


}
