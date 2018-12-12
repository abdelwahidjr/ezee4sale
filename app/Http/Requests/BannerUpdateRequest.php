<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
{public $type = ['ad' , 'market'];
    public function authorize()
    {
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
            'phone'             => 'required|string|max:150',
            'whats_app'         => 'required|string|max:150',
            'email'             => 'required|email|max:150' ,
            'image'             => 'required|mimes:png,jpg,jpeg|max:1000',
            'type'              => 'required|in:' . implode(',' , $this->type) ,
            'categories'        => 'array' ,
            'categories.*'        => 'exists:categories,id',
            'appear_on_home'    => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            "type.in" => "available type ['ad' , 'market']" ,

        ];
    }

}
