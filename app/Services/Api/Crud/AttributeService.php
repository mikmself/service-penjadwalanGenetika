<?php

namespace App\Services\Api\Crud;

use App\Models\Attribute;

class AttributeService
{
    public function getAllAttributes()
    {
        return Attribute::with('entity')->get();
    }

    public function getAttributeById($id)
    {
        return Attribute::with('entity')->findOrFail($id);
    }

    public function createAttribute(array $data)
    {
        return Attribute::create($data);
    }

    public function updateAttribute(Attribute $attribute, array $data)
    {
        $attribute->update($data);
        return $attribute;
    }

    public function deleteAttribute(Attribute $attribute)
    {
        return $attribute->delete();
    }
}