<?php

namespace App\Services\Api\Crud;

use App\Models\EntityRelationship;

class EntityRelationshipService
{
    public function getAllEntityRelationships()
    {
        return EntityRelationship::with('parentEntity', 'childEntity')->get();
    }

    public function getEntityRelationshipById($id)
    {
        return EntityRelationship::with('parentEntity', 'childEntity')->findOrFail($id);
    }

    public function createEntityRelationship(array $data)
    {
        return EntityRelationship::create($data);
    }

    public function updateEntityRelationship(EntityRelationship $entityRelationship, array $data)
    {
        $entityRelationship->update($data);
        return $entityRelationship;
    }

    public function deleteEntityRelationship(EntityRelationship $entityRelationship)
    {
        return $entityRelationship->delete();
    }
}
