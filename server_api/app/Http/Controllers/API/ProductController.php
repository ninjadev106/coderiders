<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function __construct() {
        ProductResource::withoutWrapping();
    }

    public function index()
    {
        return ProductResource::collection(Product::all());
    }
}
