<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'surname' => 'required|string|min:3|max:20',
            'name' => 'required|string|min:3|max:20',
            'patronymic' => 'nullable|string|min:3|max:20',
        ];
    }
}
