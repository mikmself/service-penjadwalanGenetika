<?php

namespace App\Http\Requests\EntitiyRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntityRelationshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_entity_id' => 'required|exists:entities,id',
            'child_entity_id' => 'required|exists:entities,id',
            'relationship_type' => 'required|string|max:255',
        ];
    }
}
