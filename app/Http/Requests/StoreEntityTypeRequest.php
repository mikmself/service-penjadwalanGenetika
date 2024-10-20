<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntityTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah sesuai kebutuhan otorisasi
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Nama entity type wajib ada
        ];
    }
}
