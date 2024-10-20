<?php

namespace App\Http\Requests\AttributeRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entity_id' => 'required|exists:entities,id',
            'name' => 'required|string|max:255',
            'data_type' => 'required|in:string,integer,datetime',
            'nullable' => 'required|boolean',
            'default_value' => 'nullable|string',
        ];
    }
}
