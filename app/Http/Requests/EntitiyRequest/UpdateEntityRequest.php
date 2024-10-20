<?php

namespace App\Http\Requests\EntitiyRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'entity_type_id' => 'sometimes|required|exists:entity_types,id',
            'schedule_id' => 'sometimes|required|exists:schedules,id',
        ];
    }
}
