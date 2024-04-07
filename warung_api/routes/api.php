<?php

use App\Http\Controllers\API\ApiAuth\AuthController as AuthController;
use App\Http\Controllers\API\Admin\UsersController;
use App\Http\Controllers\API\Pegawai\CategoryController;
use App\Http\Controllers\API\Pegawai\ProductController;
use App\Services\Repository\Response\HTTPResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'v1'], function(){

  Route::middleware('throttle:60,1')->get('/testcon', function(){
    $response = HTTPResponse::result(
      $status=(object)['status'=>200],
      $data=(object)["message" => "test connection OK!"]
    );
    return response()->json($response, $response['code']);
  })->name('api.test');

  Route::middleware('throttle:30,1')->post('/auth/login', [AuthController::class, 'login'])->name('login');

  // protected route 3 use prefix
  Route::group([
    'middleware' => [
        'auth:sanctum', 
        'throttle:60,1'
      ]
    ], function () {

      Route::group([
          'prefix' => 'admin',
          'middleware' => 'isadmin',
          'as' => 'admin.',
      ], function() {

          Route::resource('/users', UsersController::class)->only(['index','store','update']);

      });


      Route::group([
          'prefix' => 'pegawai',
          'middleware' => 'ispegawai',
          'as' => 'pegawai.',
      ], function() {

         //Route::get('/product/{id}', 'ProductController@show');
        Route::apiResource('/product', ProductController::class)->only(['index','show','store','update']);
         // Route::resource('/product', ProductController::class)->only(['index','show','store','update']);
        Route::resource('/category', CategoryController::class)->only(['index','store','update','destroy']);

      });


      Route::middleware('throttle:30,1')->get('/user/info', [AuthController::class, 'info']);
      Route::middleware('throttle:30,1')->post('/auth/logout', [AuthController::class, 'logout']);

  /*end middleware auth*/
  });

  /*end v1*/
});
