<?php

namespace App\Services\Api\Crud;

use App\Models\Entity;

class EntityService
{
    public function getAllEntities()
    {
        return Entity::with('entityType', 'schedule')->get(); // Load relations
    }

    public function getEntityById($id)
    {
        return Entity::with('entityType', 'schedule')->findOrFail($id); // Load relations
    }

    public function createEntity(array $data)
    {
        return Entity::create($data);
    }

    public function updateEntity(Entity $entity, array $data)
    {
        $entity->update($data);
        return $entity;
    }

    public function deleteEntity(Entity $entity)
    {
        return $entity->delete();
    }
}
