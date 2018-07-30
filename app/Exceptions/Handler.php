<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Bir istisna bildirme veya kaydetme.
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * HTTP yanıtına bir istisna oluşturun.
     */
    public function render($request, Exception $exception)
    {
        if($request->expectsJson()){
            if ($exception instanceof ModelNotFoundException){
                return response()->json([
                    'errors' => 'Product Model Bulunamadı.'
                ],Response::HTTP_NOT_FOUND);
            }
            
            if ($exception instanceof NotFoundHttpException){
                return response()->json([
                    'errors' => 'Url Yolu Yanlış'
                ],Response::HTTP_NOT_FOUND);
            }
        }


        return parent::render($request, $exception);
    }
}
