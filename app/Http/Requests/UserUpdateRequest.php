<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{


    public $user_languages = array('ar' , 'en');
    public $toggle_music = ['on' , 'off'];


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required|string|max:150' ,
            'email'             => 'email|unique:users|max:150' ,
            'password'          => 'required|min:6|confirmed' ,
            'phone'             => 'required|string|max:150' ,
            'language'          => 'in:' . implode(',' , (array) $this->user_languages) ,
            'toggle_music'      => 'in:' . implode(',' , (array) $this->toggle_music) ,
        ];
    }


    public function messages()
    {
        return [
            "language.in" => "available languages ". implode(',' , (array) $this->user_languages) ,
            "toggle_music.in" => "available toggle_music ". implode(',' , (array) $this->toggle_music) ,
        ];
    }
}

