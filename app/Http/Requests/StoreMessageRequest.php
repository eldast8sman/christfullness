<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'series_id' => 'integer|exists:\App\Models\Series,id',
            'minister_id' => 'required|integer|exists:\App\Models\Minister,id',
            'image_path' => 'required|mimes:jpg,jpeg,png,gif'
        ];
    }
}
