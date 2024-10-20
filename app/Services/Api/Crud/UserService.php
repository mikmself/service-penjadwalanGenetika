<?php

namespace App\Services\Api\Crud;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class UserService
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function createUser(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $data['password'] = Hash::make($data['password']);
                return User::create($data);
            });
        } catch (Exception $e) {
            throw new Exception('Error creating user: ' . $e->getMessage());
        }
    }

    public function updateUser(User $user, array $data)
    {
        try {
            return DB::transaction(function () use ($user, $data) {
                if (isset($data['password'])) {
                    $data['password'] = Hash::make($data['password']);
                }
                $user->update($data);
                return $user;
            });
        } catch (Exception $e) {
            throw new Exception('Error updating user: ' . $e->getMessage());
        }
    }

    public function deleteUser(User $user)
    {
        try {
            return DB::transaction(function () use ($user) {
                return $user->delete();
            });
        } catch (Exception $e) {
            throw new Exception('Error deleting user: ' . $e->getMessage());
        }
    }
}
