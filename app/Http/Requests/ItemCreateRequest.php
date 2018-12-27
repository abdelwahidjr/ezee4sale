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
            'title'              => 'required|string|max:150' ,
            'type'          => 'in:' . implode(',' , $this->type) ,
            'user_id'       => 'required|exists:users,id',
            'whats_app'             => 'required|string|max:15' ,
            'place'             => 'required|max:150' ,
            'phone'             => 'required|string|max:15' ,
            'category_id'        => 'required|exists:categories,id' ,
            'sub_category_id'        => 'required|exists:sub_categories,id' ,
            'state'      => 'in:' . implode(',' , $this->state) ,
            'order'             => 'number|max:15' ,
            'image'        => 'required|array|min:1' ,
            'image.*'      => 'required|mimes:png,jpg,jpeg|max:1000' ,
            'appear_on_home'             => 'boolean' ,
            'image_size_w'  =>'numeric|max:2000'  ,
            'image_size_h'  =>'numeric|max:2000'
        ];
    }


    public function messages()
    {
        return [
            "type.in" => "available type ". implode(',' , $this->type) ,
            "state.in" => "available state ". implode(',' ,  $this->state) ,
        ];
    }
}