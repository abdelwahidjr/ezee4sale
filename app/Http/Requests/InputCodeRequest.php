<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputCodeRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code'              => 'required|exists:coupons,code' ,
            'user_id'       => 'required|exists:users,id',
        ];
    }

}