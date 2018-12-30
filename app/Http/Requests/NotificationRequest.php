<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
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
            'message.*.key' => 'required',
            'message.*.body' => 'required',
            'player_ids' => 'required_without:segment',
            'segment' => 'required_without:player_ids',
            'data' => 'array'
        ];
    }
}
