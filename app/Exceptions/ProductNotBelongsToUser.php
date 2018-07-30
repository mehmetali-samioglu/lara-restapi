<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUser extends Exception
{
    //exception kelime anlamı İSTİSNA demektir.
    //Kullanıcılara özel istisna işlemlerde kullnaıyruz. vs.

    public function render()
    {
        return  ['errors ' => 'Ürün Kullanıcıya Ait Değil.'];
    }
}
