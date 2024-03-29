<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
public $type = ['ad' , 'market'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name'             => 'required|string|max:350',
            'ar_name'           => 'string',
            'price'         => 'required|numeric',
            'ordering'             => 'required|numeric',
            'deprecated_time'             => 'required|numeric',
            'type'              => 'required|in:' . implode(',' , $this->type) ,

        ];
    }

    public function messages()
    {
        return [
            "type.in" => "available type ['ad' , 'market']" ,

        ];
    }
}
