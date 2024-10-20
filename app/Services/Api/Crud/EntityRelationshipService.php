<?php

namespace App\Services\Api\Crud;

use App\Models\EntityRelationship;
use Illuminate\Support\Facades\DB;
use Exception;

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
        try {
            return DB::transaction(function () use ($data) {
                return EntityRelationship::create($data);
            });
        } catch (Exception $e) {
            throw new Exception('Error creating entity relationship: ' . $e->getMessage());
        }
    }

    public function updateEntityRelationship(EntityRelationship $entityRelationship, array $data)
    {
        try {
            return DB::transaction(function () use ($entityRelationship, $data) {
                $entityRelationship->update($data);
                return $entityRelationship;
            });
        } catch (Exception $e) {
            throw new Exception('Error updating entity relationship: ' . $e->getMessage());
        }
    }

    public function deleteEntityRelationship(EntityRelationship $entityRelationship)
    {
        try {
            return DB::transaction(function () use ($entityRelationship) {
                return $entityRelationship->delete();
            });
        } catch (Exception $e) {
            throw new Exception('Error deleting entity relationship: ' . $e->getMessage());
        }
    }
}
