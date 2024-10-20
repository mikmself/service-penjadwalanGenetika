<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntitiyRequest\StoreEntityTypeRequest;
use App\Http\Requests\EntitiyRequest\UpdateEntityTypeRequest;
use App\Models\EntityType;
use App\Services\Api\Crud\EntityTypeService;
use Illuminate\Http\JsonResponse;

class EntityTypeController extends Controller
{
    protected $entityTypeService;

    public function __construct(EntityTypeService $entityTypeService)
    {
        $this->entityTypeService = $entityTypeService;
    }

    public function index(): JsonResponse
    {
        $entityTypes = $this->entityTypeService->getAllEntityTypes();
        return response()->json($entityTypes);
    }

    public function show($id): JsonResponse
    {
        $entityType = $this->entityTypeService->getEntityTypeById($id);
        return response()->json($entityType);
    }

    public function store(StoreEntityTypeRequest $request): JsonResponse
    {
        $entityType = $this->entityTypeService->createEntityType($request->validated());
        return response()->json($entityType, 201);
    }

    public function update(UpdateEntityTypeRequest $request, EntityType $entityType): JsonResponse
    {
        $updatedEntityType = $this->entityTypeService->updateEntityType($entityType, $request->validated());
        return response()->json($updatedEntityType);
    }

    public function destroy(EntityType $entityType): JsonResponse
    {
        $this->entityTypeService->deleteEntityType($entityType);
        return response()->json(null, 204);
    }
}
