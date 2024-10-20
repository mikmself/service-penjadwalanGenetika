<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntityRelationshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah jika perlu otorisasi
    }

    public function rules(): array
    {
        return [
            'parent_entity_id' => 'required|exists:entities,id', // Validasi parent_entity_id harus ada di table entities
            'child_entity_id' => 'required|exists:entities,id', // Validasi child_entity_id harus ada di table entities
            'relationship_type' => 'required|string|max:255', // Tipe hubungan harus berupa string
        ];
    }
}
