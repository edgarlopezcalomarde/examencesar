<?php

use App\Http\Controllers\Api\ActoresController;
use App\Http\Controllers\Api\DirectoresController;
use App\Http\Controllers\Api\PeliculasController;
use App\Http\Controllers\Api\UsuariosController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::apiResource("/peliculas", PeliculasController::class);
Route::apiResource("/actor", ActoresController::class);
Route::apiResource("/director", DirectoresController::class);

Route::post("/login", [AuthController::class, "login"]);
Route::post("/refresh", [AuthController::class, "refreshToken"]);

Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::apiResource("/usuarios", UsuariosController::class);
    Route::post("/logout", [AuthController::class, "logOut"]);

});
