<?php

namespace App\Http\Controllers\API\Pegawai;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsCollection;
use App\Models\Product;
use App\Services\Repository\Response\HTTPResponse;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //return response()->json($response, 200);
      // return new ProductsCollection(Product::paginate(2), 200);
      $product = Product::paginate(25);
    
      $response = HTTPResponse::result($status=(object)['status'=>200], $product);

      return response()->json($response, $response['code']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $fields = $request->validate([
        "name" => "required|string",
        "categoryId" => "required|string",
        "price" => "required|string",
        "status" => "required|string"
      ]);

      $product = Product::create([
        'name' => $request['name'],
        'categoryId' => (int) $request['categoryId'],
        'price' => (int) $request['price'],
        'status' => (int) $request['status'],
      ]);

      $response = HTTPResponse::result($status=(object)['status' => 201], $product);

      return response()->json($response, $response['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
      $product = Product::find($product)->first();

      if($product)
      {
        $response = HTTPResponse::result(
          $status=(object)['status' => 200], 
          $product
        );
      }
      else
      {
        $response = HTTPResponse::error(
          $status=(object)['status' => 404], 
          $message="Product's Not Found!"
        );
      }

      return response()->json($response, $response['code']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $fields = $request->validate([
        "name" => "required|string",
        "categoryId" => "required|string",
        "price" => "required|string",
        "status" => "required|string",
      ]);

      $product = Product::find($id);

      if($product)
      {
        $product->update($request->all());

        $response = HTTPResponse::result(
          $status=(object)['status'=>200], 
          $product
        );  
      }
      else 
      {
        $response = HTTPResponse::error(
          $status=(object)['status'=>404], 
          $message="Product's Not Found!"
        );  
      }

      return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
