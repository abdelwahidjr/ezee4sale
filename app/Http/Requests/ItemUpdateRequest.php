<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
            'whats_app'             => 'required|string|max:15' ,
            'place'             => 'required|max:150' ,
            'phone'             => 'required|string|max:15' ,
            'category_id'        => 'required|exists:categories,id' ,
            'sub_category_id'        => 'required|exists:sub_categories,id' ,
            'state'      => 'in:' . implode(',' , $this->state) ,
            'order'             => 'required|number|max:15' ,
            'images'        => 'required|array|min:1',
            'appear_on_home'             => 'boolean' ,
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