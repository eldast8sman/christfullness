<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'summary' => 'required|string',
            'minister_id' => 'required|integer|exists:\App\Models\Minister,id',
            'book_path' => 'mimes:pdf',
            'image_path' => 'mimes:jpg,jpeg,png'
        ];
    }
}
