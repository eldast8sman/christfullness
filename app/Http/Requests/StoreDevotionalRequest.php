<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDevotionalRequest extends FormRequest
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
            'minister_id' => 'required|integer|exists:ministers,id',
            'devotional_date' => 'required|date|unique:devotionals',
            'topic' => 'required|string|max:255',
            'bible_text' => 'required|string|max:255',
            'memory_verse_text' => 'required|string|max:255',
            'memory_verse' => 'required|string',
            'devotional' => 'required'
        ];
    }
}
