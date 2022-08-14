<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMinisterRequest extends FormRequest
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
            'appearance' => 'required|integer',
            'name' => 'required|string|max:500',
            'position' => 'required|string|max:255',
            'filepath' => 'required|mimes:jpg,jpeg,png'
        ];
    }
}
