<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeValueRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Models\AttributeValue;
use App\Services\AttributeValueService;
use Illuminate\Http\JsonResponse;

class AttributeValueController extends Controller
{
    protected $attributeValueService;

    public function __construct(AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
    }

    public function index(): JsonResponse
    {
        $attributeValues = $this->attributeValueService->getAllAttributeValues();
        return response()->json($attributeValues);
    }

    public function show($id): JsonResponse
    {
        $attributeValue = $this->attributeValueService->getAttributeValueById($id);
        return response()->json($attributeValue);
    }

    public function store(StoreAttributeValueRequest $request): JsonResponse
    {
        $attributeValue = $this->attributeValueService->createAttributeValue($request->validated());
        return response()->json($attributeValue, 201);
    }

    public function update(UpdateAttributeValueRequest $request, AttributeValue $attributeValue): JsonResponse
    {
        $updatedAttributeValue = $this->attributeValueService->updateAttributeValue($attributeValue, $request->validated());
        return response()->json($updatedAttributeValue);
    }

    public function destroy(AttributeValue $attributeValue): JsonResponse
    {
        $this->attributeValueService->deleteAttributeValue($attributeValue);
        return response()->json(null, 204);
    }
}
