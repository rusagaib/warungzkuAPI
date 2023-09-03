<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\Paginator;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         return parent::toArray($request);
      // return ['data' => $this->collection];
    }

   // public function withResponse($request, $response){
   //   $response->header('x-value', 'jmbot');
   // }
    //


    public function paginationInformation($request){

      $paginated = $this->resource->toArray();

      return [
        'paginated' => [
          'current_page' => $paginated['current_page'],
          'per_page' => $paginated['per_page'],
          'total' => $paginated['total'],
          'total_page' => $paginated['last_page'],
          'first_page_url' => $paginated['first_page_url'],
          'last_page_url' => $paginated['last_page_url'],
          'next_page_url' => $paginated['next_page_url'],
          'prev_page_url' => $paginated['prev_page_url'],
          'path' => $paginated['path'],
        ],
      ];
    }
}
