<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => "User login successfully"
            ];
            return response()->json($response);
        } else {
            $response = [
                'success' => false,
                'message' => "Unauthorized"
            ];
            return response()->json($response);
        }
    }

    public function getUser($token)
    {
        $token = PersonalAccessToken::findToken($token);
        $user = $token->tokenable;
        return response()->json(['user' => $user]);
    }

    public function logout($token)
    {
        $token = PersonalAccessToken::findToken($token);
        $token->delete();
        $response = [
            'message' => 'Logget Out!'
        ];
        return response($response);
    }
}
