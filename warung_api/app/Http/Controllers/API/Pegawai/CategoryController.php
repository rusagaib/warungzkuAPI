<?php

namespace App\Http\Controllers\API\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Repository\Response\HTTPResponse;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $category = Category::all();

      $response = HTTPResponse::result(
        $status=(object)['status' => 200], 
        $category
      );

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
        "name" => "required"
      ]);

      $kategori = Category::create($fields["name"]);

      $response = HTTPResponse::result(
        $status=(object)['status' => 201], 
        $kategori
      );

      return response()->json($response, $response['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        "name" => "required"
      ]);

      $kategori = Category::find($fields['name']);

      if($kategori)
      {
        $kategori->update($fields['name']);

        $response = HTTPResponse::result(
          $status=(object)['status' => 200], 
          $kategori
        );
      }
      else 
      {
        $response = HTTPResponse::error(
          $status=(object)['status' => 404], 
          $message="Categories Not Found!!"
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
      $kategori = Category::find($id);

      if($kategori)
      {
        $kategori->delete();

        $response = HTTPResponse::result(
          $status = (object)['status' => 410], 
          $kategori
        );
      }
      else
      {
        $response = HTTPResponse::error(
          $status = (object)['status' => 404], 
          $message="Categories Not Found!"
        );
      }

      return response()->json($response, $response['code']);
    }
}
