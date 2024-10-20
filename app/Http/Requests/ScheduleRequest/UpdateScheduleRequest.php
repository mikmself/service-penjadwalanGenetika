<?php

namespace App\Http\Requests\ScheduleRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah sesuai logika otorisasi.
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'start_time' => 'sometimes|required|date',
            'end_time' => 'sometimes|required|date|after:start_time',
        ];
    }
}
