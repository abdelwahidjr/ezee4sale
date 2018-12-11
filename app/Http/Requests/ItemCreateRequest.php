<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCreateRequest extends FormRequest
{

    public $type = ['ad', 'market'];
    public $state = ['pinned', 'featured', 'none'];


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
            'language'          => 'in:' . implode(',' , $this->type) ,
            'toggle_music'      => 'in:' . implode(',' , $this->state) ,
        ];
    }


    public function messages()
    {
        return [
            "language.in" => "available language ". implode(',' , $this->type) ,
            "toggle_music.in" => "available toggle_music ". implode(',' ,  $this->state) ,
        ];
    }
}