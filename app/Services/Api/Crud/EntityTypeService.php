<?php

namespace App\Services\Api\Crud;

use App\Models\EntityType;
use Illuminate\Support\Facades\DB;
use Exception;

class EntityTypeService
{
    public function getAllEntityTypes()
    {
        return EntityType::all();
    }

    public function getEntityTypeById($id)
    {
        return EntityType::findOrFail($id);
    }

    public function createEntityType(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                return EntityType::create($data);
            });
        } catch (Exception $e) {
            throw new Exception('Error creating entity type: ' . $e->getMessage());
        }
    }

    public function updateEntityType(EntityType $entityType, array $data)
    {
        try {
            return DB::transaction(function () use ($entityType, $data) {
                $entityType->update($data);
                return $entityType;
            });
        } catch (Exception $e) {
            throw new Exception('Error updating entity type: ' . $e->getMessage());
        }
    }

    public function deleteEntityType(EntityType $entityType)
    {
        try {
            return DB::transaction(function () use ($entityType) {
                return $entityType->delete();
            });
        } catch (Exception $e) {
            throw new Exception('Error deleting entity type: ' . $e->getMessage());
        }
    }
}
