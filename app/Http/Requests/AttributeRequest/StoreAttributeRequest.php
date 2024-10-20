<?php

namespace App\Http\Requests\AttributeRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah jika ada otorisasi
    }

    public function rules(): array
    {
        return [
            'entity_id' => 'required|exists:entities,id', // Validasi entity_id harus ada
            'name' => 'required|string|max:255', // Nama attribute
            'data_type' => 'required|in:string,integer,datetime', // Tipe data harus salah satu dari enum
            'nullable' => 'required|boolean', // Field nullable harus boolean
            'default_value' => 'nullable|string', // Nilai default bisa null
        ];
    }
}
