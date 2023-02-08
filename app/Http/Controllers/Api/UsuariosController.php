<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios, 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "password" => "required"
        ]);

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->password = $request->password;
        $usuario->save();

        return response()->json($usuario, 201);
    }


    public function show(Usuario $usuario)
    {
        return response()->json($usuario, 200);
    }


    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            "nombre" => "required",
            "password" => "required"
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->password = $request->password;
        $usuario->save();

        return response()->json($usuario, 201);
    }


    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json("", 204);
    }
}
