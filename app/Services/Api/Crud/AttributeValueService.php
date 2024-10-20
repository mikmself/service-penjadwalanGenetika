<?php

namespace App\Services\Api\Crud;

use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;
use Exception;

class AttributeValueService
{
    public function getAllAttributeValues()
    {
        return AttributeValue::with('attribute')->get();
    }

    public function getAttributeValueById($id)
    {
        return AttributeValue::with('attribute')->findOrFail($id);
    }

    public function createAttributeValue(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                return AttributeValue::create($data);
            });
        } catch (Exception $e) {
            throw new Exception('Error creating attribute value: ' . $e->getMessage());
        }
    }

    public function updateAttributeValue(AttributeValue $attributeValue, array $data)
    {
        try {
            return DB::transaction(function () use ($attributeValue, $data) {
                $attributeValue->update($data);
                return $attributeValue;
            });
        } catch (Exception $e) {
            throw new Exception('Error updating attribute value: ' . $e->getMessage());
        }
    }

    public function deleteAttributeValue(AttributeValue $attributeValue)
    {
        try {
            return DB::transaction(function () use ($attributeValue) {
                return $attributeValue->delete();
            });
        } catch (Exception $e) {
            throw new Exception('Error deleting attribute value: ' . $e->getMessage());
        }
    }
}
