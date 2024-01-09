<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{


    private $product;


    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function index(Request $request){

        $products = $this->product;
        
        if($request->has('conditions')){
            $conditions = explode(';', $request->get('conditions'));
            

            foreach($conditions as $condition){
                $ci = explode('=',$condition);
                $products = $products->where($ci[0],$ci[1]);
            }
        }

        if($request->has('fields')){
            $fields = $request->get('fields');
            $products = $products->selectRaw($fields);

        }
        ///return response()->json($products);

        return new ProductCollection($products->paginate(10));
    }    
    
    public function show($id){
       $products = $this->product->find($id);

       ///return response()->json($products);
       return new ProductResource($products);
    }

    public function save(Request $request){
       
        $data = $request->all();
        $product = $this->product->create($data);
        return response()->json($product);
    }

    public function update(Request $request){
       
        $data = $request->all();
        $product = $this->product->find($data['id']);
        $product->update($data);

        return response()->json($product);
    }

    public function delete($id){
       
        
        $product = $this->product->find($id);
        $product->delete();

        return response()->json(['data'=> ['msg' => 'produto removido']]);
    }

}
