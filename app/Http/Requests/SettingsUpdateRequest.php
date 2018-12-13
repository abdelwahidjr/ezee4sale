<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
{

    public $audio_state = ['on', 'off'];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file'              => 'array' , // TODO add validation
            'audio_file_state'              => 'in:' . implode(',' , $this->audio_state) ,
            'whats_app'          => 'array' ,
            'whats_app.*'          => 'string' ,
            'phone'          => 'array' ,
            'phone.*'          => 'string' ,
            'email'          => 'array' ,
            'email.*'          => 'email|string' ,
        ];
    }
    public function messages()
    {
        return [
            "audio_file_state.in" => "available state ". implode(',' , $this->audio_state) ,
        ];
    }
}