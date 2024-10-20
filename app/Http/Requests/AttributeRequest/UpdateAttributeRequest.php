<?php

namespace App\Http\Requests\AttributeRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'data_type' => 'sometimes|required|in:string,integer,datetime',
            'nullable' => 'sometimes|required|boolean',
            'default_value' => 'nullable|string',
        ];
    }
}
