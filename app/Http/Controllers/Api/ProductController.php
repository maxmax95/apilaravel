<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{


    private $product;


    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function index(){
        $products = $this->product->all();

        return response()->json($products);
    }

    public function save(Request $request){
       
        $data = $request->all();
        $product = $this->product->create($data);
        return response()->json($product);
    }
}
