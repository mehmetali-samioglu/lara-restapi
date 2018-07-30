<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//trait = kişisel özellik anlamındadır.
trait ExceptionTrait
{
    public function apiException($request, $e)
    {
        if ($this->isModel($e)){
            return $this->ModelResponse($e);
        }

            if ($this->isHttp($e)){
                return $this->HttpResponse($e);
            }

                return parent::render($request, $e);
    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function ModelResponse($e)
    {
        return response()->json([
            'errors' => 'Product Modeli Bulunamadı.'
        ],Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse($e)
    {
        return response()->json([
            'errors' => 'Url Yolu Yanlış.'
        ],Response::HTTP_NOT_FOUND);
    }

}