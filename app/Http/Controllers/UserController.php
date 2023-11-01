<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(UserRequest $request): JsonResponse
    {
        $request->validateEmail = true;
        $user = new User();

        $user->fill($request->only(['email', 'username', 'name']));
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user
        ],201);
    }

    public function index(Request $request) : JsonResponse
    {
        $user = auth()->guard('header')->user();

        if ($user->is_blocked) {
            return response()->json([
                'success' => false,
                'message' => 'User is blocked'
            ],406);
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User is not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'id' => $user->id,
            'email' => $user->email,
            'username' => $user->username,
            'name' => $user->name
        ]);
    }

    public function update(UserRequest $request) : JsonResponse
    {
        $user = auth()->guard('header')->user();

        if ($user->is_blocked) {
            return response()->json([
                'success' => false,
                'message' => 'User is blocked'
            ],406);
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User is not found'
            ], 404);
        }

        $user->fill($request->only(['username', 'name']));

        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function destroy(Request $request) : JsonResponse
    {
        $user = auth()->guard('header')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User is not found'
            ], 404);
        }

        if ($user->is_blocked) {
            return response()->json([
                'success' => false,
                'message' => 'User is blocked'
            ],406);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted'
        ]);
    }
}
