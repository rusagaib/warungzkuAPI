<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'warungapi_products';

    protected $fillable = [
        'name',
        'categoryId',
        'price',
        'quantity',
        'status',
    ];
}
