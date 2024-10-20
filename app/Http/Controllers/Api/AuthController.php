<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Services\Api\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->authService->register($request->validated());
            DB::commit();
            return $this->sendResponse($user, 'User registered successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Failed to register user', [$e->getMessage()]);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $this->authService->login($request->validated());
            return $this->sendResponse($data, 'User logged in successfully');
        } catch (\Exception $e) {
            return $this->sendError('Login failed', [$e->getMessage()], 401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request->user());
            return $this->sendResponse(null, 'User logged out successfully');
        } catch (\Exception $e) {
            return $this->sendError('Logout failed', [$e->getMessage()]);
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $this->authService->forgotPassword($request->validated());
            return $this->sendResponse(null, 'Password reset link sent to your email');
        } catch (\Exception $e) {
            return $this->sendError('Failed to send reset link', [$e->getMessage()]);
        }
    }
    public function profile(Request $request)
    {
        // Mengambil informasi user yang sedang login
        $user = $request->user();

        // Menggunakan response template yang sudah ada
        return $this->sendResponse($user, 'User profile retrieved successfully');
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->authService->resetPassword($request->validated());
            DB::commit();
            return $this->sendResponse(null, 'Password reset successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Password reset failed', [$e->getMessage()]);
        }
    }
}
