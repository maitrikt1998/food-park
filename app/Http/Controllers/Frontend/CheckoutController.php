<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $addresses = Address::where(['user_id'=>auth()->user()->id])->get();
        $deliveryAreas = DeliveryArea::where('status',1)->get();
        return view('frontend.pages.checkout',compact('addresses','deliveryAreas'));
    }

    public function CalculationDeliveryCharge(string $id)
    {
        try{
            $address = Address::findOrFail($id);
            $deliveryFee = $address->deliveryArea->delivery_fee;
            $grandTotal = grandCartTotal() + $deliveryFee;
            return response(['delivery_fee' => $deliveryFee, 'grand_total' => $grandTotal], 200);
        }catch(\Exception $e){
            return response(['message' => 'Something Went Wrong!'],422);
        }
        
    }
}
