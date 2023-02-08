<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum',['except' => ['index', 'show']]);
    }

    public function index()
    {
       $peliculas = Pelicula::all();
       return response()->json($peliculas, 200);
    }


    public function store(Request $request)
    {

        $request->validate([
            "titulo" => "required|unique:peliculas",
            "año" => "required",
            "duracion" => "required",
            "director_id" => "required"
        ]);

        $pelicula = new Pelicula();
        $pelicula->titulo = $request->titulo;
        $pelicula->año = $request->año;
        $pelicula->duracion = $request->duracion;
        $pelicula->director_id = $request->director_id;
        $pelicula->save();

        return response()->json($pelicula, 201);
    }


    public function show(Pelicula $pelicula)
    {
        $pelicula->director;
        $pelicula->actores;
        return response()->json($pelicula, 200);
    }


    public function update(Request $request, Pelicula $pelicula)
    {

        $request->validate([
            "titulo" => "required", //|unique:pelicula
            "año" => "required",
            "duracion" => "required",
            "director_id" => "required"
        ]);

        $pelicula->titulo = $request->titulo;
        $pelicula->año = $request->año;
        $pelicula->duracion = $request->duracion;
        $pelicula->director_id = $request->director_id;
        $pelicula->save();

        return response()->json($pelicula, 201);
    }

    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return response()->json(null, 204);
    }
}
