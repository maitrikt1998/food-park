<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PaymentController extends Controller
{
    //
    public function index(): View
    {
        if(!session()->has('delivery_fee') || !session()->has('address')){
            throw ValidationException::withMessages(['something went wrong!!']);
        }
        $subtotal = cartTotal();
        $delivery = session()->get('delivery_fee') ?? 0;
        \Log::info(session()->get('coupon')['discount']);
        $discount = session()->get('coupon')['discount'] ?? 0;
        $carttotal = grandCartTotal($delivery);
        return view('frontend.pages.payment', compact('subtotal','delivery', 'discount', 'carttotal'));
    }

    public function makePayment(Request $request, OrderService $orderService){
        $request->validate([
            'payment_gateway' => ['required','string','in:paypal']
        ]);

        /** Create order */
        try{
            $orderService->createOrder();
        }catch(\Exception $e){
            throw $e;
        }
    }
}
