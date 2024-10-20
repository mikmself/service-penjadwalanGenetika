<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest\StoreAttributeRequest;
use App\Http\Requests\AttributeRequest\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Services\Api\Crud\AttributeService;
use Illuminate\Http\JsonResponse;

class AttributeController extends Controller
{
    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function index(): JsonResponse
    {
        $attributes = $this->attributeService->getAllAttributes();
        return response()->json($attributes);
    }

    public function show($id): JsonResponse
    {
        $attribute = $this->attributeService->getAttributeById($id);
        return response()->json($attribute);
    }

    public function store(StoreAttributeRequest $request): JsonResponse
    {
        $attribute = $this->attributeService->createAttribute($request->validated());
        return response()->json($attribute, 201);
    }

    public function update(UpdateAttributeRequest $request, Attribute $attribute): JsonResponse
    {
        $updatedAttribute = $this->attributeService->updateAttribute($attribute, $request->validated());
        return response()->json($updatedAttribute);
    }

    public function destroy(Attribute $attribute): JsonResponse
    {
        $this->attributeService->deleteAttribute($attribute);
        return response()->json(null, 204);
    }
}
