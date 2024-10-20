<?php

namespace App\Services\Api\Crud;

use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
use Exception;

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
        try {
            return DB::transaction(function () use ($data) {
                return Attribute::create($data);
            });
        } catch (Exception $e) {
            throw new Exception('Error creating attribute: ' . $e->getMessage());
        }
    }

    public function updateAttribute(Attribute $attribute, array $data)
    {
        try {
            return DB::transaction(function () use ($attribute, $data) {
                $attribute->update($data);
                return $attribute;
            });
        } catch (Exception $e) {
            throw new Exception('Error updating attribute: ' . $e->getMessage());
        }
    }

    public function deleteAttribute(Attribute $attribute)
    {
        try {
            return DB::transaction(function () use ($attribute) {
                return $attribute->delete();
            });
        } catch (Exception $e) {
            throw new Exception('Error deleting attribute: ' . $e->getMessage());
        }
    }
}
