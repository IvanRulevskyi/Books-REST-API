<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:30',
            'description' => 'required|string',
            'publication_date' => 'required|date',
            'author_id' => 'required|array',
        ];
    }
}
