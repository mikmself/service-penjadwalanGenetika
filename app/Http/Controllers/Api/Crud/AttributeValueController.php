<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest\StoreAttributeValueRequest;
use App\Http\Requests\AttributeRequest\UpdateAttributeValueRequest;
use App\Models\AttributeValue;
use App\Services\Api\Crud\AttributeValueService;
use Illuminate\Http\JsonResponse;
use Exception;

class AttributeValueController extends Controller
{
    protected $attributeValueService;

    public function __construct(AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
    }

    public function index(): JsonResponse
    {
        try {
            $attributeValues = $this->attributeValueService->getAllAttributeValues();
            return $this->sendResponse($attributeValues, 'Attribute values retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve attribute values.', [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $attributeValue = $this->attributeValueService->getAttributeValueById($id);
            return $this->sendResponse($attributeValue, 'Attribute value retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve attribute value.', [$e->getMessage()]);
        }
    }

    public function store(StoreAttributeValueRequest $request): JsonResponse
    {
        try {
            $attributeValue = $this->attributeValueService->createAttributeValue($request->validated());
            return $this->sendResponse($attributeValue, 'Attribute value created successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError('Failed to create attribute value.', [$e->getMessage()]);
        }
    }

    public function update(UpdateAttributeValueRequest $request, AttributeValue $attributeValue): JsonResponse
    {
        try {
            $updatedAttributeValue = $this->attributeValueService->updateAttributeValue($attributeValue, $request->validated());
            return $this->sendResponse($updatedAttributeValue, 'Attribute value updated successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to update attribute value.', [$e->getMessage()]);
        }
    }

    public function destroy(AttributeValue $attributeValue): JsonResponse
    {
        try {
            $this->attributeValueService->deleteAttributeValue($attributeValue);
            return $this->sendResponse(null, 'Attribute value deleted successfully.', 204);
        } catch (Exception $e) {
            return $this->sendError('Failed to delete attribute value.', [$e->getMessage()]);
        }
    }
}
