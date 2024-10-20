<?php

namespace App\Services\Api\Crud;

use App\Models\Entity;
use Illuminate\Support\Facades\DB;
use Exception;

class EntityService
{
    public function getAllEntities()
    {
        return Entity::with('entityType', 'schedule')->get();
    }

    public function getEntityById($id)
    {
        return Entity::with('entityType', 'schedule')->findOrFail($id);
    }

    public function createEntity(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                return Entity::create($data);
            });
        } catch (Exception $e) {
            throw new Exception('Error creating entity: ' . $e->getMessage());
        }
    }

    public function updateEntity(Entity $entity, array $data)
    {
        try {
            return DB::transaction(function () use ($entity, $data) {
                $entity->update($data);
                return $entity;
            });
        } catch (Exception $e) {
            throw new Exception('Error updating entity: ' . $e->getMessage());
        }
    }

    public function deleteEntity(Entity $entity)
    {
        try {
            return DB::transaction(function () use ($entity) {
                return $entity->delete();
            });
        } catch (Exception $e) {
            throw new Exception('Error deleting entity: ' . $e->getMessage());
        }
    }
}
