<?php

namespace App\Http\Controllers\API\ApiAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Repository\Response\HTTPResponse;
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
        $response = HTTPResponse::error(
          $status=(object)['status'=>422], 
          $message="Email or Password Not Valid!"
        );
        return response()->json($response, $response['code']);
      }

      $token = $user->createToken('auth-token')->plainTextToken;

      $response = HTTPResponse::result(
        $status=(object)['status'=>202], 
        $data=(object)['token'=>$token]
      );

      return response()->json($response, $response['code']);
    }


    public function info(Request $request)
    {
      $response = HTTPResponse::result(
        $status=(object)['status'=>200], 
        $request->user()
      );

      return response()->json($response, $response['code']);
    }


    public function logout(Request $request)
    {
      $request->user()->currentAccessToken()->delete();

      $response = HTTPResponse::result(
        $status=(object)['status'=>200], 
        $data=['message' => 'Tokens Revoked']
      );

      return response()->json($response, $response['code']);
    }
}
