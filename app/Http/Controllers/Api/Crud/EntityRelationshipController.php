<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntitiyRequest\StoreEntityRelationshipRequest;
use App\Http\Requests\EntitiyRequest\UpdateEntityRelationshipRequest;
use App\Models\EntityRelationship;
use App\Services\Api\Crud\EntityRelationshipService;
use Illuminate\Http\JsonResponse;
use Exception;

class EntityRelationshipController extends Controller
{
    protected $entityRelationshipService;

    public function __construct(EntityRelationshipService $entityRelationshipService)
    {
        $this->entityRelationshipService = $entityRelationshipService;
    }

    public function index(): JsonResponse
    {
        try {
            $relationships = $this->entityRelationshipService->getAllEntityRelationships();
            return $this->sendResponse($relationships, 'Entity relationships retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve entity relationships.', [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $relationship = $this->entityRelationshipService->getEntityRelationshipById($id);
            return $this->sendResponse($relationship, 'Entity relationship retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve entity relationship.', [$e->getMessage()]);
        }
    }

    public function store(StoreEntityRelationshipRequest $request): JsonResponse
    {
        try {
            $relationship = $this->entityRelationshipService->createEntityRelationship($request->validated());
            return $this->sendResponse($relationship, 'Entity relationship created successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError('Failed to create entity relationship.', [$e->getMessage()]);
        }
    }

    public function update(UpdateEntityRelationshipRequest $request, EntityRelationship $entityRelationship): JsonResponse
    {
        try {
            $updatedRelationship = $this->entityRelationshipService->updateEntityRelationship($entityRelationship, $request->validated());
            return $this->sendResponse($updatedRelationship, 'Entity relationship updated successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to update entity relationship.', [$e->getMessage()]);
        }
    }

    public function destroy(EntityRelationship $entityRelationship): JsonResponse
    {
        try {
            $this->entityRelationshipService->deleteEntityRelationship($entityRelationship);
            return $this->sendResponse(null, 'Entity relationship deleted successfully.', 204);
        } catch (Exception $e) {
            return $this->sendError('Failed to delete entity relationship.', [$e->getMessage()]);
        }
    }
}
