<?php

namespace App\Exceptions;

use Throwable;
use Psr\Log\LogLevel;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];


    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];



    protected function shouldReturnJson($request, Throwable $e){
        return true;
    }


    public function register()
    {
        $this->renderable(function (Throwable $exception) {
            if (request()->is('api*')) {
                if ($exception instanceof ModelNotFoundException) {

                    return response()->json(['error' => 'Recurso no encontrado'], 404);
                } else if ($exception instanceof ValidationException) {

                    return response()->json(['error' => 'Datos no válidos'], 400);
                } else if (isset($exception)) {

                    return response()->json(['error' => 'Error: ' . $exception->getMessage()], 500);
                }
            }
        });
    }
}
