<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntityRequest;
use App\Http\Requests\UpdateEntityRequest;
use App\Models\Entity;
use App\Services\EntityService;
use Illuminate\Http\JsonResponse;

class EntityController extends Controller
{
    protected $entityService;

    public function __construct(EntityService $entityService)
    {
        $this->entityService = $entityService;
    }

    public function index(): JsonResponse
    {
        $entities = $this->entityService->getAllEntities();
        return response()->json($entities);
    }

    public function show($id): JsonResponse
    {
        $entity = $this->entityService->getEntityById($id);
        return response()->json($entity);
    }

    public function store(StoreEntityRequest $request): JsonResponse
    {
        $entity = $this->entityService->createEntity($request->validated());
        return response()->json($entity, 201);
    }

    public function update(UpdateEntityRequest $request, Entity $entity): JsonResponse
    {
        $updatedEntity = $this->entityService->updateEntity($entity, $request->validated());
        return response()->json($updatedEntity);
    }

    public function destroy(Entity $entity): JsonResponse
    {
        $this->entityService->deleteEntity($entity);
        return response()->json(null, 204);
    }
}
