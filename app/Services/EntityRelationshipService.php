<?php

namespace App\Services;

use App\Models\EntityRelationship;

class EntityRelationshipService
{
    public function getAllEntityRelationships()
    {
        return EntityRelationship::with('parentEntity', 'childEntity')->get(); // Memuat relasi parent dan child
    }

    public function getEntityRelationshipById($id)
    {
        return EntityRelationship::with('parentEntity', 'childEntity')->findOrFail($id); // Memuat relasi parent dan child
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
