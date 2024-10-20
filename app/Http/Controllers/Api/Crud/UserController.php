<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest\StoreUserRequest;
use App\Http\Requests\UserRequest\UpdateUserRequest;
use App\Models\User;
use App\Services\Api\Crud\UserService;
use Illuminate\Http\JsonResponse;
use Exception;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getAllUsers();
            return $this->sendResponse($users, 'Users retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve users.', [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $user = $this->userService->getUserById($id);
            return $this->sendResponse($user, 'User retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve user.', [$e->getMessage()]);
        }
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->createUser($request->validated());
            return $this->sendResponse($user, 'User created successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError('Failed to create user.', [$e->getMessage()]);
        }
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        try {
            $updatedUser = $this->userService->updateUser($user, $request->validated());
            return $this->sendResponse($updatedUser, 'User updated successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to update user.', [$e->getMessage()]);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        try {
            $this->userService->deleteUser($user);
            return $this->sendResponse(null, 'User deleted successfully.', 204);
        } catch (Exception $e) {
            return $this->sendError('Failed to delete user.', [$e->getMessage()]);
        }
    }
}
