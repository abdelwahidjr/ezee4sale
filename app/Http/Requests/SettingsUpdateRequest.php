<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file'              => 'array' , // TODO add validation
            'whats_app'          => 'array' ,
            'whats_app.*'          => 'string' ,
            'phone'          => 'array' ,
            'phone.*'          => 'string' ,
            'email'          => 'array' ,
            'email.*'          => 'email|string' ,
        ];
    }

}