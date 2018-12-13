<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendNotificationsRequest extends FormRequest
{
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
            'user_ids'        => 'required|array|min:1' ,
            'user_ids.*'        => 'required|exists:users,id',
            'item_id'        => 'required|exists:items,id',
        ];
    }
}
