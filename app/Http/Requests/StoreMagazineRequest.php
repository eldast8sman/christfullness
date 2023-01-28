<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMagazineRequest extends FormRequest
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
            'title' => 'required|string',
            'publication_date' => 'required|string',
            'summary' => 'required|string',
            'image_file' => 'required|mimes:jpg,jpeg,png,gif',
            'pdf_file' => 'required|mimes:pdf'
        ];
    }
}
