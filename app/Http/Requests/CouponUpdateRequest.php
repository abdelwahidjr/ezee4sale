<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
            'user_id'       => 'exists:users,id',
        ];
    }

}