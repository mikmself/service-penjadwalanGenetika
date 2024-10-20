<?php

namespace App\Services\Api\Crud;

use App\Models\AttributeValue;

class AttributeValueService
{
    public function getAllAttributeValues()
    {
        return AttributeValue::with('attribute')->get(); // Memuat relasi ke Attribute
    }

    public function getAttributeValueById($id)
    {
        return AttributeValue::with('attribute')->findOrFail($id); // Memuat relasi ke Attribute
    }

    public function createAttributeValue(array $data)
    {
        return AttributeValue::create($data);
    }

    public function updateAttributeValue(AttributeValue $attributeValue, array $data)
    {
        $attributeValue->update($data);
        return $attributeValue;
    }

    public function deleteAttributeValue(AttributeValue $attributeValue)
    {
        return $attributeValue->delete();
    }
}
