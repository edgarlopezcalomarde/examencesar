<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum',['except' => ['index', 'show']]);
    }

    public function index()
    {
        $director = Director::all();
        return response()->json($director, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "apellido" => "required"
        ]);

        $director = new Director();
        $director->nombre = $request->nombre;
        $director->apellido = $request->apellido;
        $director->save();

        return response()->json($director, 201);
    }


    public function show(Director $director)
    {
        $director->peliculas;
        return response()->json($director, 200);
    }


    public function update(Request $request, Director $director)
    {
        $request->validate([
            "nombre" => "required",
            "apellido" => "required"
        ]);

        $director->nombre = $request->nombre;
        $director->apellido = $request->apellido;
        $director->save();

        return response()->json($director, 201);
    }


    public function destroy(Director $director)
    {
        $director->delete();
        return response()->json("", 204);
    }
}
