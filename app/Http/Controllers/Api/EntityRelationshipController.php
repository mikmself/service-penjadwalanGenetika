<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntityRelationshipRequest;
use App\Http\Requests\UpdateEntityRelationshipRequest;
use App\Models\EntityRelationship;
use App\Services\EntityRelationshipService;
use Illuminate\Http\JsonResponse;

class EntityRelationshipController extends Controller
{
    protected $entityRelationshipService;

    public function __construct(EntityRelationshipService $entityRelationshipService)
    {
        $this->entityRelationshipService = $entityRelationshipService;
    }

    public function index(): JsonResponse
    {
        $relationships = $this->entityRelationshipService->getAllEntityRelationships();
        return response()->json($relationships);
    }

    public function show($id): JsonResponse
    {
        $relationship = $this->entityRelationshipService->getEntityRelationshipById($id);
        return response()->json($relationship);
    }

    public function store(StoreEntityRelationshipRequest $request): JsonResponse
    {
        $relationship = $this->entityRelationshipService->createEntityRelationship($request->validated());
        return response()->json($relationship, 201);
    }

    public function update(UpdateEntityRelationshipRequest $request, EntityRelationship $entityRelationship): JsonResponse
    {
        $updatedRelationship = $this->entityRelationshipService->updateEntityRelationship($entityRelationship, $request->validated());
        return response()->json($updatedRelationship);
    }

    public function destroy(EntityRelationship $entityRelationship): JsonResponse
    {
        $this->entityRelationshipService->deleteEntityRelationship($entityRelationship);
        return response()->json(null, 204);
    }
}
