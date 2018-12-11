<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{

    public $languages = ['ar' , 'en'];
    public $toggle_music = ['on' , 'off'];


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required|string|max:150' ,
            'email'             => 'required|email|unique:users|max:150' ,
            'password'          => 'required|min:6|confirmed' ,
            'phone'             => 'required|string|max:150' ,
            'language'          => 'in:' . implode(',' , $this->languages) ,
            'toggle_music'      => 'in:' . implode(',' , $this->toggle_music) ,
        ];
    }


    public function messages()
    {
        return [
            "language.in" => "available language ". implode(',' , $this->languages) ,
            "toggle_music.in" => "available toggle_music ". implode(',' ,  $this->toggle_music) ,
        ];
    }
}