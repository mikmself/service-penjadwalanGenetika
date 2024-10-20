<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah jika perlu otorisasi
    }

    public function rules(): array
    {
        return [
            'attribute_id' => 'required|exists:attributes,id', // Validasi bahwa attribute_id harus ada
            'value_string' => 'nullable|string', // Nilai jika tipe string
            'value_int' => 'nullable|integer', // Nilai jika tipe integer
            'value_datetime' => 'nullable|date', // Nilai jika tipe datetime
        ];
    }
}
