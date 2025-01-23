<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderPaymentUpdateEvent;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    //
    public function index(): View
    {
        if (!session()->has('delivery_fee') || !session()->has('address')) {
            throw ValidationException::withMessages(['something went wrong!!']);
        }
        $subtotal = cartTotal();
        $delivery = session()->get('delivery_fee') ?? 0;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $carttotal = grandCartTotal($delivery);
        return view('frontend.pages.payment', compact('subtotal', 'delivery', 'discount', 'carttotal'));
    }

    public function makePayment(Request $request, OrderService $orderService)
    {
        $request->validate([
            'payment_gateway' => ['required', 'string', 'in:paypal']
        ]);
        /** Create order */
        if ($orderService->createOrder()) {
            //redirect user to payment host
            switch ($request->payment_gateway) {
                case 'paypal':
                    return response(['redirect_url' => route('paypal.payment')]);

                default:
                    break;
            }
        }
    }

    /** Pay With Paypal */

    public function setpaypalConfig()
    {
        $config = [
            'mode' => config('gatewaySettings.paypal_account_mode'),
            'sandbox' => [
                'client_id' => config('gatewaySettings.paypal_api_key'),
                'client_secret' => config('gatewaySettings.paypal_secret_key'),
                'app_id' => 'APP-80W284485P519543T',
            ],

            'live' => [
                'client_id' => config('gatewaySettings.paypal_api_key'),
                'client_secret' => config('gatewaySettings.paypal_secret_key'),
                'app_id' => 'APP-80W284485P519543T',
            ],

            'payment_action' => 'Sale',
            'currency' => config('gatewaySettings.paypal_currency'),
            'notify_url' => env('PAYPAL_NOTIFY_URL', ''),
            'locale' => 'en_US',
            'validate_ssl' => true,
        ];

        return $config;
    }

    public function payWithPaypal()
    {
        $config = $this->setpaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $grandTotal = session()->get('grand_total');
        $payableAmount = round($grandTotal * config('gatewaySettings.paypal_rate'));


        $response = $provider->createOrder([
            'intent' => "CAPTURE",
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('gatewaySettings.paypal_currency'),
                        'value' => $payableAmount,
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id'] != NULL){
            foreach($response['links'] as $link){
                if($link['rel'] == 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        }else{

        }

    }

    public function paypalSuccess(Request $request)
    {
        $config = $this->setpaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $respose = $provider->capturePaymentOrder($request->token);
        if(isset($respose['status']) && $respose['status'] === 'COMPLETED'){
            $orderId = session()->get('order_id');
            $capture = $respose['purchase_units'][0]['payments']['captures'][0];
            $paymentInfo = [
                'transaction_id' => $capture['id'],
                'currency' => $capture['amount']['currency_code'],
                'status' => $capture['status']
            ];

            OrderPaymentUpdateEvent::dispatch($orderId,$paymentInfo,'PayPal');
        }
    }

    public function paypalCancel()
    {

    }
}
