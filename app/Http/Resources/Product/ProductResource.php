<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Kaynağı bir diziye dönüştürün.
     * Özel dizi ile api olşuturuyoruz
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //burada Product modelinin detayları  dönüştürüldü.
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out of Stock' : $this->stock,
            'discount' => $this->discount,
            'totalPrice' => round((1-($this->discount/100))*$this->price,2),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),1):'Henüz Değerlendirme Yok.',
            'href' => [
                'reviews' => route('reviews.index',$this->id)
            ]
        ];
    }
}
