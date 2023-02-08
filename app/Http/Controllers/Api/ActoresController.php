<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActoresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum',['except' => ['index', 'show']]);
    }

    public function index()
    {
       $actores = Actor::all();
       return response()->json($actores, 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "edad" => "required"
        ]);

        $actor = new Actor();
        $actor->nombre = $request->nombre;
        $actor->edad = $request->edad;
        $actor->save();

        return response()->json($actor, 201);
    }


    public function show(Actor $actor)
    {
        $actor->peliculas;
        return response()->json($actor, 200);
    }


    public function update(Request $request, Actor $actor)
    {

        $request->validate([
            "nombre" => "required",
            "edad" => "required"
        ]);

        $actor->nombre = $request->nombre;
        $actor->edad = $request->edad;
        $actor->save();

        return response()->json($actor, 201);
    }


    public function destroy(Actor $actor)
    {
        $actor->delete();
        return response()->json("", 204);
    }
}
