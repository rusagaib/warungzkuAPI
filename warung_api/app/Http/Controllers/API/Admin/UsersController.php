<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
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

      $response = [
        'status' => [
          'code' => "200",
          'message' => "OK",
        ],
        'data' => $users,
      ];

      return response()->json($response, 200);
    }

    public function store(Request $request)
    {

      $validator = Validator::make($request->all(), [
        'name' => ['required'],
        'email' => ['required', 'unique:users,email'],
        'password' => ['required'],
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors(),
        422);
      }

      try {
        $user = User::create([
          'name' => $request['name'],
          'email' => $request['email'],
          'password' => bcrypt($request['password'])
        ]);

        $response = [
          'massage' => 'User Created!',
          'data' => $user
        ];

        return response()->json($response, 201);

      } catch (QueryException $e) {
          return response()->json([
              'massage' => 'Failed' . $e->errorInfo
          ]);
      }

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

      $user = User::findOrFail($id);

      $validator = Validator::make($request->all(), [
        'name' => ['required'],
        'email' => ['required', 'email'],
        // 'password' => ['required'],
        // 'address' => ['required'],
        'roleId' => ['required', 'numeric'],
        'status' => ['required', 'boolean'],
        // 'qty' => ['required', 'in:IN,OUT'],
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors(),
        422);
      }

      try {
        $user->update($request->all());
        $response = [
          'massage' => 'User Updated!',
          'data' => $user
        ];

        return response()->json($response, 200);

      } catch (QueryException $e) {
          return response()->json([
              'massage' => 'Failed' . $e->errorInfo
          ]);
      }
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
