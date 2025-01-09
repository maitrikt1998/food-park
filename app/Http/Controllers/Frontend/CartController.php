<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function addToCart(Request $request){
        $product = Product::with(['productSize','productOption'])->findOrFail($request->product_id);
        $productSize = $product->productSize->where('id',$request->product_size)->first();
        $productOptions = $product->productOption->WhereIn('id',$request->product_option);
        $options = [
            'product_size' => [
                'id' => $productSize->id,
                'name' => $productSize->name,
                'price' => $productSize->price
            ],
            'product_options' => []
        ];

        foreach($productOptions as $option){
            $options['product_options'][] =[
                'id' => $option->id,
                'name' => $option->name,
                'price' => $option->price
            ];
        }
    }
}
