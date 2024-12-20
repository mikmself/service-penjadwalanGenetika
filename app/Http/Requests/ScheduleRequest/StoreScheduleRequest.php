<?php

namespace App\Http\Requests\ScheduleRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah sesuai logika otorisasi.
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id', // Validasi user harus ada
            'name' => 'required|string|max:255', // Nama schedule
        ];
    }
}
