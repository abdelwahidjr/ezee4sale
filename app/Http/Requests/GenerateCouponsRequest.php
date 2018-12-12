<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateCouponsRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'              => 'required|string|max:150' ,
            'price'          => 'required|integer|min:1' ,
            'quantity'       => 'required|integer|min:1',
        ];
    }

}