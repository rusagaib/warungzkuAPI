<?php

namespace App\Http\Controllers\API\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

       $response = [
         'status' => [
           'code' => "200",
           'message' => "OK",
         ],
         'data' => $category,
       ];

      return response()->json($response, 200);
   //
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
          'name' => ['required'],
        ]);

        if ($validator->fails()) {
          return response()->json($validator->errors(),
          422);
        }

        try {
          $kategori = Category::create($request->all());
          $response = [
            'massage' => 'Category Created!',
            'data' => $kategori
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

        $kategori = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
          'name' => ['required'],
          // 'qty' => ['required', 'in:IN,OUT'],
        ]);

        if ($validator->fails()) {
          return response()->json($validator->errors(),
          422);
        }

        try {
          $kategori->update($request->all());
          $response = [
            'massage' => 'kategori Updated!',
            'data' => $kategori
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $kategori = Category::findOrFail($id);

      try {
        $kategori->delete();
        $response = [
          'massage' => 'kategori deleted!',
        ];

        return response()->json($response, 410);

      } catch (QueryException $e) {
          return response()->json([
              'massage' => 'Failed' . $e->errorInfo
          ]);
      }
    }
}
