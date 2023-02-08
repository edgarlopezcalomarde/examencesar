<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RefreshTokens;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    function login(Request $request){

        $usuario = Usuario::where("nombre", $request->nombre)->first();

        if(!$usuario || !Hash::check($request->password, $usuario->password)){
            return response()->json(['error' => 'Credenciales no válidas'], 401);
        }else{

            return response()->json([
                'access_token' => $usuario->createToken($usuario->nombre,['*'], now()->addMinutes(2))->plainTextToken,
                'refresh_token' =>$this->createRefreshToken($usuario->id)
            ]);
        }
    }


    function createRefreshToken(int $idUsuario){
        $tokenRefresco = new RefreshTokens();

        $tokengenerated =  hash('sha256', $plainTextToken = Str::random(40));

        $tokenRefresco->id_usuario = $idUsuario;
        $tokenRefresco->token =  $tokengenerated;
        $tokenRefresco->expires_in = now()->addDays(10);
        $tokenRefresco->activo = true;
        $tokenRefresco->save();

        return $tokengenerated;
    }


    function refreshToken(Request $request){

        $header = $request->header('Authorization'); //Envio el refresh token por el authorization
        $refreshtoken = Str::substr($header, 7);


        $result = RefreshTokens::where("token",$refreshtoken)->get()->first();

        if($result->token != $refreshtoken){
            return response()->json(["message" => "Error el refresh token es invalido"], 400);
        }

        if($result->activo == false){
            return response()->json(["message" => "Error el refresh token no esta activo"], 400);
        }

        if(Carbon::parse($result->expires_in) < Carbon::now()){
            return response()->json(["message" => "Error el refresh token expiro vuelva a loguearse"], 400);
        }

        $usuario = Usuario::where("id", $result->id_usuario)->first();

        return response()->json([
            'access_token' => $usuario->createToken($usuario->nombre,['*'], now()->addMinutes(2))->plainTextToken,
            'refresh_token' =>$this->createRefreshToken($usuario->id)
        ]);

    }


    // function logOut(Request $request){
    //     $header = $request->header('Authorization'); //Envio el refresh token por el authorization
    // }

}
