<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntityTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah sesuai kebutuhan otorisasi
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255', // Nama bisa di-update jika diperlukan
        ];
    }
}
