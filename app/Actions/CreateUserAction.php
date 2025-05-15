<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function execute(Request $request): array
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'gender' => 'required|in:male,female,other',
            ]);
            $validated['password'] = Hash::make($validated['password']);
            $user = User::create(
                $validated
            );
            $token = $user->createToken('api-token')->plainTextToken;
            $success = true;
            $message = "User register successfully";
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $success = false;
            $token = '';
        }

        return [
            'success' => $success,
            'message' => $message,
            'token' => $token,
        ];
    }
}
