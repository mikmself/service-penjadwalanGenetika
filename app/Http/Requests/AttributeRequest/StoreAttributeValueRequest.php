<?php

namespace App\Http\Requests\AttributeRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attribute_id' => 'required|exists:attributes,id',
            'value_string' => 'nullable|string',
            'value_int' => 'nullable|integer',
            'value_datetime' => 'nullable|date',
        ];
    }
}
