<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Kullanıcının bu isteği yapmaya yetkili olup olmadığını belirleyin.
     *
     * @return bool
     */
    public function authorize()
    {
        //TRUE yaptık
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>'required|max:255|unique:products', // ismi products tablsua göre tekrarsız olacak
            'description' => 'required',
            'price' =>'required:max:10',
            'stock' =>'required:max:6',
            'discount' => 'required|max:2'
        ];
    }
}
