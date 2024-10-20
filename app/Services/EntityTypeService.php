<?php

namespace App\Services;

use App\Models\EntityType;

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
        return EntityType::create($data);
    }

    public function updateEntityType(EntityType $entityType, array $data)
    {
        $entityType->update($data);
        return $entityType;
    }

    public function deleteEntityType(EntityType $entityType)
    {
        return $entityType->delete();
    }
}
