<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntitiyRequest\StoreEntityTypeRequest;
use App\Http\Requests\EntitiyRequest\UpdateEntityTypeRequest;
use App\Models\EntityType;
use App\Services\Api\Crud\EntityTypeService;
use Illuminate\Http\JsonResponse;
use Exception;

class EntityTypeController extends Controller
{
    protected $entityTypeService;

    public function __construct(EntityTypeService $entityTypeService)
    {
        $this->entityTypeService = $entityTypeService;
    }

    public function index(): JsonResponse
    {
        try {
            $entityTypes = $this->entityTypeService->getAllEntityTypes();
            return $this->sendResponse($entityTypes, 'Entity types retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve entity types.', [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $entityType = $this->entityTypeService->getEntityTypeById($id);
            return $this->sendResponse($entityType, 'Entity type retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve entity type.', [$e->getMessage()]);
        }
    }

    public function store(StoreEntityTypeRequest $request): JsonResponse
    {
        try {
            $entityType = $this->entityTypeService->createEntityType($request->validated());
            return $this->sendResponse($entityType, 'Entity type created successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError('Failed to create entity type.', [$e->getMessage()]);
        }
    }

    public function update(UpdateEntityTypeRequest $request, EntityType $entityType): JsonResponse
    {
        try {
            $updatedEntityType = $this->entityTypeService->updateEntityType($entityType, $request->validated());
            return $this->sendResponse($updatedEntityType, 'Entity type updated successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to update entity type.', [$e->getMessage()]);
        }
    }

    public function destroy(EntityType $entityType): JsonResponse
    {
        try {
            $this->entityTypeService->deleteEntityType($entityType);
            return $this->sendResponse(null, 'Entity type deleted successfully.', 204);
        } catch (Exception $e) {
            return $this->sendError('Failed to delete entity type.', [$e->getMessage()]);
        }
    }
}
