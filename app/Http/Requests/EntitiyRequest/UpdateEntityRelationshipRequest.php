<?php

namespace App\Http\Requests\EntitiyRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntityRelationshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_entity_id' => 'sometimes|required|exists:entities,id',
            'child_entity_id' => 'sometimes|required|exists:entities,id',
            'relationship_type' => 'sometimes|required|string|max:255',
        ];
    }
}
