<?php

namespace App\Http\Requests\EntitiyRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'entity_type_id' => 'required|exists:entity_types,id',
            'schedule_id' => 'required|exists:schedules,id',
        ];
    }
}
