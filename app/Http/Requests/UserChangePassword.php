<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePassword extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'old_password' => 'required|min:6' ,
            'password'     => 'required|min:6|confirmed' ,
        ];
    }
}
