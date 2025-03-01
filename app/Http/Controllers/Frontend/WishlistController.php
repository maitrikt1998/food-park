<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WishlistController extends Controller
{
    //
    function store(string $productId) : Response
    {
        $productAlreadyExist = Wishlist::where(['user_id'=>auth()->user()->id, 'product_id' => $productId])->exists();

        if($productAlreadyExist)
        {
            throw ValidationException::withMessages(['Product is already add to wishlist']);
        }

        if(!Auth::check()){
            throw ValidationException::withMessages(['Please login firs to add product inwishlist']);
        }
        $wishlist = new Wishlist();
        $wishlist->user_id = auth()->user()->id;
        $wishlist->product_id = $productId;
        $wishlist->save();

        return response(['status' => 'success', 'message' => 'product added to wishlist!']);
    }
}
