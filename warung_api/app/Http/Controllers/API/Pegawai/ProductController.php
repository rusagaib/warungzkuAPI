<?php

namespace App\Http\Controllers\API\Pegawai;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsCollection;
use App\Models\Product;
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
       //$products = Product::all();
       //$products = Product::paginate(10);
       //$products = new ProductsCollection(Product::paginate(4));

       /*
       $paginate = [
         "total" => 40,
         "per_page" => 8,
         "current_page" => 1,
         "last_page" => 5,
         "first_page_url" => "http://127.0.0.1:8080/<ops-name>?page=1",
         "last_page_url" => "http://127.0.0.1:8080/<ops-name>?page=5",
         "next_page_url" => "http://127.0.0.1:8080/<ops-name>?page=2",
         "prev_page_url" => null
       ];
        */


      /*
       $response = [
         'status' => [
           'code' => "200",
           'message' => "OK",
         ],
         'data' => $products
       ];
      */

      //return response()->json($response, 200);
      return new ProductsCollection(Product::paginate(2), 200);

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
        $validator = Validator::make($request->all(), [
          'name' => ['required', 'string'],
          'categoryId' => ['required', 'string'],
          'price' => ['required', 'string'],
          'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
          return response()->json($validator->errors(),
          422);
        }

        try {
          $product = Product::create([
            'name' => $request['name'],
            'categoryId' => (int) $request['categoryId'],
            'price' => (int) $request['price'],
            'status' => (int) $request['status'],
          ]);
          $response = [
            'massage' => 'Product Created!',
            'data' => $product
          ];

          return response()->json($response, 201);

        } catch (QueryException $e) {
            return response()->json([
                'massage' => 'Failed' . $e->errorInfo
            ]);
        }
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
      try {
        $response = [
            'massage' => 'Product Found!',
            'data' => $product
        ];
        return response()->json($response, 200);
      }
      catch (QueryException $e) {
        return response()->json([
          'massage' => 'Failed' . $e->errorInfo
        ]);
      }
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

        $product = Product::findOrFail($id);
        $validator = Validator::make($request->all(), [
          'name' => ['required', 'string'],
          'categoryId' => ['required', 'string'],
          'price' => ['required', 'string'],
          'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
          return response()->json($validator->errors(),
          422);
        }

        try {
          $product->update($request->all());
          $response = [
            'massage' => 'Barang Updated!',
            'data' => $product
          ];

          return response()->json($response, 200);

        } catch (QueryException $e) {
            return response()->json([
                'massage' => 'Failed' . $e->errorInfo
            ]);
        }
        //
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
