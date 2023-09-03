<?php

namespace App\Http\Controllers\API\ApiAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

      $request->validate([
          'email' => ['required'],
          'password' => ['required'],
      ]);

      $user = User::where('email', $request->email)->first();

      if (!$user || !Hash::check($request->password, $user->password)){
        return response()->json([
          'massage' => 'Email or Password Not Valid!'
        ], 422);
      }

      $token = $user->createToken('auth-token')->plainTextToken;

      $response = [
        'massage' => 'successful',
        'token' => $token
      ];

      return response()->json($response, 200);
    }

    public function info(Request $request)
    {
        return response()->json([
          'massage' => 'User Info',
          'data' => $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        // $user->tokens()->delete();
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
