<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Repository\Response\HTTPResponse;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function index()
    {
      $users = User::all();

      $response = HTTPResponse::result($status=(object)['status'=>200], $users);

      return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
      $validator = $request->validate([
        "name" => "required",
        "email" => "required|unique:users,email",
        "password" => "required",
      ]);

      $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => bcrypt($request['password'])
      ]);

      $response = HTTPResponse::result($status=(object)['status'=>201], $user);

      return response()->json($response, $response['code']);
    }


    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, User $user)
    public function update(Request $request, $id)
    {
      $fields = $request->validate([
        "name" => "required",
        "email" => "required|email",
        // "password" => "required",
        // "address" => "required",
        "roleId" => "required|numeric",
        "status" => "required|boolean"
      ]);

      $user = User::find($id);

      if($user)
      {
        $user->update([
          "name" => $fields['name'],
          "email" => $fields['email'],
          "roleId" => $fields['roleId'],
          "status" => $fields['status']
        ]);
  
        $response = HTTPResponse::result($status=(object)['status'=>200], $user);
      }
      else
      {
        $response = HTTPResponse::error($status=(object)['status'=>404], $message="User's Not Found!");
      }

      return response()->json($response, $response["code"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
