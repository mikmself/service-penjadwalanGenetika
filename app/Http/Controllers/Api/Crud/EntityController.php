<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntitiyRequest\StoreEntityRequest;
use App\Http\Requests\EntitiyRequest\UpdateEntityRequest;
use App\Models\Entity;
use App\Services\Api\Crud\EntityService;
use Illuminate\Http\JsonResponse;
use Exception;

class EntityController extends Controller
{
    protected $entityService;

    public function __construct(EntityService $entityService)
    {
        $this->entityService = $entityService;
    }

    public function index(): JsonResponse
    {
        try {
            $entities = $this->entityService->getAllEntities();
            return $this->sendResponse($entities, 'Entities retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve entities.', [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $entity = $this->entityService->getEntityById($id);
            return $this->sendResponse($entity, 'Entity retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve entity.', [$e->getMessage()]);
        }
    }

    public function store(StoreEntityRequest $request): JsonResponse
    {
        try {
            $entity = $this->entityService->createEntity($request->validated());
            return $this->sendResponse($entity, 'Entity created successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError('Failed to create entity.', [$e->getMessage()]);
        }
    }

    public function update(UpdateEntityRequest $request, Entity $entity): JsonResponse
    {
        try {
            $updatedEntity = $this->entityService->updateEntity($entity, $request->validated());
            return $this->sendResponse($updatedEntity, 'Entity updated successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to update entity.', [$e->getMessage()]);
        }
    }

    public function destroy(Entity $entity): JsonResponse
    {
        try {
            $this->entityService->deleteEntity($entity);
            return $this->sendResponse(null, 'Entity deleted successfully.', 200);
        } catch (Exception $e) {
            return $this->sendError('Failed to delete entity.', [$e->getMessage()]);
        }
    }
}
