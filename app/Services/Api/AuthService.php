<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
    public function login(array $data)
    {
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw new \Exception('Invalid credentials');
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout($user)
    {
        if ($user->currentAccessToken() && !($user->currentAccessToken() instanceof \Laravel\Sanctum\TransientToken)) {
            $user->currentAccessToken()->delete();
        } else {
            $user->tokens()->delete();
        }
    }

    public function forgotPassword(array $data)
    {
        $status = Password::sendResetLink(['email' => $data['email']]);

        if ($status !== Password::RESET_LINK_SENT) {
            throw new \Exception('Failed to send reset link');
        }
    }

    public function resetPassword(array $data)
    {
        $status = Password::reset($data, function (User $user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        if ($status !== Password::PASSWORD_RESET) {
            throw new \Exception('Failed to reset password');
        }
    }
}
