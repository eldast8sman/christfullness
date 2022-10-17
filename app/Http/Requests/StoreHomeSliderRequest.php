<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeSliderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'position' => 'required|integer',
            'filename' => 'required|mimes:png,jpg,jpeg',
            'caption' => 'required|string',
            'call_to_action' => 'required_with:link',
            'link' => 'required_with:call_to_action'
        ];
    }
}
