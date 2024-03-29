<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerCreateRequest extends FormRequest
{
    public $type = ['ad' , 'market'];
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
            'sub_categories'        => 'array' ,
            'sub_categories.*'        => 'exists:sub_categories,id',
            'appear_on_home'    => 'boolean',
            'image_size_w'  =>'numeric|max:2000'  ,
            'image_size_h'  =>'numeric|max:2000'
        ];
    }
    public function messages()
    {
        return [
            "type.in" => "available type ['ad' , 'market']" ,

        ];
    }
}
