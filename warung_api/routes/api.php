<?php

use App\Http\Controllers\API\ApiAuth\AuthController as AuthController;
use App\Http\Controllers\API\Admin\UsersController;
use App\Http\Controllers\API\Pegawai\CategoryController;
use App\Http\Controllers\API\Pegawai\ProductController;
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

  Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

  // protected route 3 use prefix
  Route::group(
    ['middleware' => ['auth:sanctum']], function () {

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



      Route::get('/user/info', [AuthController::class, 'info']);
      Route::post('/auth/logout', [AuthController::class, 'logout']);

  /*end middleware auth*/
  });

  /*end v1*/
});



/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */

/*
Route::get('/test', function(){

    return response()->json(
      [
        'status' => [ 'code' => 0, 'message' => "succesfull" ],
        'data' => array(
          ['desc' => "this is example data 1"],
          ['desc' => "this is example data 2"]
        ),
        'paginate' => ['total-page'=>2, 'current-page'=>1, 'next-page'=>2]
      ], 200);
});
*/
