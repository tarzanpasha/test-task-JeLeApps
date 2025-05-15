<?php

namespace App\Http\Controllers\api;

use App\Actions\CreateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request, CreateUserAction $action): JsonResponse
    {

        return response()->json(
            $action->execute($request)
        );
    }

    public function profile(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
