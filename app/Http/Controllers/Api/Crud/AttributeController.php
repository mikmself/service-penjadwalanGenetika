<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest\StoreAttributeRequest;
use App\Http\Requests\AttributeRequest\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Services\Api\Crud\AttributeService;
use Illuminate\Http\JsonResponse;
use Exception;

class AttributeController extends Controller
{
    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function index(): JsonResponse
    {
        try {
            $attributes = $this->attributeService->getAllAttributes();
            return $this->sendResponse($attributes, 'Attributes retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve attributes.', [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $attribute = $this->attributeService->getAttributeById($id);
            return $this->sendResponse($attribute, 'Attribute retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve attribute.', [$e->getMessage()]);
        }
    }

    public function store(StoreAttributeRequest $request): JsonResponse
    {
        try {
            $attribute = $this->attributeService->createAttribute($request->validated());
            return $this->sendResponse($attribute, 'Attribute created successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError('Failed to create attribute.', [$e->getMessage()]);
        }
    }

    public function update(UpdateAttributeRequest $request, Attribute $attribute): JsonResponse
    {
        try {
            $updatedAttribute = $this->attributeService->updateAttribute($attribute, $request->validated());
            return $this->sendResponse($updatedAttribute, 'Attribute updated successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to update attribute.', [$e->getMessage()]);
        }
    }

    public function destroy(Attribute $attribute): JsonResponse
    {
        try {
            $this->attributeService->deleteAttribute($attribute);
            return $this->sendResponse(null, 'Attribute deleted successfully.', 204);
        } catch (Exception $e) {
            return $this->sendError('Failed to delete attribute.', [$e->getMessage()]);
        }
    }
}
