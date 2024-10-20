<?php

namespace App\Http\Requests\AttributeRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah jika perlu otorisasi
    }

    public function rules(): array
    {
        return [
            'value_string' => 'nullable|string',
            'value_int' => 'nullable|integer',
            'value_datetime' => 'nullable|date',
        ];
    }
}
