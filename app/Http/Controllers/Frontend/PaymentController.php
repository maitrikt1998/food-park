<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderPaymentUpdateEvent;
use App\Events\OrderPlacedNotificationEvent;
use App\Events\RTOorderPlacedNotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\False_;
use phpDocumentor\Reflection\Types\Void_;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Razorpay\Api\Api as RazorpayApi;

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

    public function paymentSuccess(): View
    {
        return view('frontend.pages.payment-success');
    }

    public function paymentCancel(): View
    {
        return view('frontend.pages.payment-cancel');

    }

    public function makePayment(Request $request, OrderService $orderService)
    {
        $request->validate([
            'payment_gateway' => ['required', 'string', 'in:paypal,stripe,razorpay']
        ]);
        /** Create order */
        if ($orderService->createOrder()) {
            //redirect user to payment host
            switch ($request->payment_gateway) {
                case 'paypal':
                    return response(['redirect_url' => route('paypal.payment')]);

                case 'stripe':
                    return response(['redirect_url' => route('stripe.payment')]);

                case 'razorpay':
                    return response(['redirect_url' => route('razorpay-redirect')]);

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
                // 'app_id' => 'APP-80W284485P519543T',
            ],

            'live' => [
                'client_id' => config('gatewaySettings.paypal_api_key'),
                'client_secret' => config('gatewaySettings.paypal_secret_key'),
                'app_id' => config('gatewaySettings.app_id'),
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
        try{
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
            \Log::info($response['id']);

            if(isset($response['id']) && $response['id'] != NULL){
                foreach($response['links'] as $link){
                    \Log::info($link);
                    if($link['rel'] == 'approve'){
                        \Log::info('Redirecting to PayPal:', ['url' => $link['href']]);
                        return redirect()->away($link['href']);
                    }
                }
            }else{
                $this->transactionFailUpdateStatus('PayPal');
                return redirect()->route('payment.cancel')->withErrors(['error' => $response['error']['message']]);
            }
        }catch(Exception $e){
            \Log::error('PayPal Error: ' . $e->getMessage());
        }
    }

    public function paypalSuccess(Request $request, OrderService $orderService)
    {
        $config = $this->setpaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if(isset($response['status']) && $response['status'] === 'COMPLETED'){
            $orderId = session()->get('order_id');
            $capture = $response['purchase_units'][0]['payments']['captures'][0];
            $paymentInfo = [
                'transaction_id' => $capture['id'],
                'currency' => $capture['amount']['currency_code'],
                'status' => 'completed'
            ];

            OrderPaymentUpdateEvent::dispatch($orderId,$paymentInfo,'PayPal');
            OrderPlacedNotificationEvent::dispatch($orderId);
            RTOorderPlacedNotificationEvent::dispatch(Order::find($orderId));

            /** Clear Session  Data*/
            $orderService->clearSession();

            return redirect()->route('payment.success');
        }else{
            $this->transactionFailUpdateStatus('PayPal');
            return redirect()->route('payment.cancel')->withErrors(['errors' =>$response]);
        }
    }

    public function paypalCancel()
    {
        $this->transactionFailUpdateStatus('PayPal');
        return redirect()->route('payment.cancel');
    }

    /** Stripe Payment */
    public function payWithStripe()
    {
        Stripe::setApiKey(config('gatewaySettings.stripe_secret_key'));

        $grandTotal = session()->get('grand_total');
        $payableAmount = round($grandTotal * config('gatewaySettings.paypal_rate')) * 100;
        $response = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' =>config('gatewaySettings.stripe_currency'),
                        'product_data' => [
                            'name' => 'Product'
                        ],
                        'unit_amount' => $payableAmount
                    ],
                    'quantity' => 1
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel').'?session_id={CHECKOUT_SESSION_ID}',
        ]);
        return redirect()->away($response->url);
    }

    public function stripeSuccess(Request $request, OrderService $orderService)
    {
        $sessionId = $request->session_id;

        Stripe::setApiKey(config('gatewaySettings.stripe_secret_key'));
        $response = StripeSession::retrieve($sessionId);
        if($response->payment_status === 'paid')
        {
            $orderId = session()->get('order_id');

            // $capture = $response['purchase_units'][0]['payments']['captures'][0];
            $paymentInfo = [
                'transaction_id' => $response->payment_intent,
                'currency' => $response->currency,
                'status' => 'completed'
            ];

            OrderPaymentUpdateEvent::dispatch($orderId, $paymentInfo, 'stripe');
            OrderPlacedNotificationEvent::dispatch($orderId);
            RTOorderPlacedNotificationEvent::dispatch(Order::find($orderId));

            /** Clear Session  Data*/
            $orderService->clearSession();

            return redirect()->route('payment.success');
        }else{

            $this->transactionFailUpdateStatus('stripe');
            return redirect()->route('payment.cancel');
        }
    }

    public function stripeCancel()
    {
        $this->transactionFailUpdateStatus('stripe');
        return 'cancel';
    }

    /** Pay With Razorpay */

    public function razorpayRedirect()
    {
        return redirect('frontend.pages.razorpay-redirect');
    }

    public function payWithRazorpay(Request $request, OrderService $orderService)
    {
        $api = new RazorpayApi(
            config('gatewaySettings.razorpay_api_key'),
            config('gatewaySettings.razorpay_secret_key'),
        );

        if($request->has('razorpay_payment_id') && $request->filled('razorpay_payment_id')){
            $grandTotal = session()->get('grand_total');
            $payableAmount = ($grandTotal * config('gatewaySettings.razorpay_rate')) * 100;
            try{
                $response = $api->payment
                ->fetch($request->razorpay_payment_id)
                ->capture(['amount' => $payableAmount]);
            }catch(\Exception $e){
                logger($e);
                $this->transactionFailUpdateStatus('Razorpay');
                return redirect()->route('payment.cancel')->withErrors($e->getMessage());
            }

            if($response['status'] === 'captured'){
                $orderId = session()->get('order_id');
                $paymentInfo = [
                    'transaction_id' => $response->id,
                    'currency' => config('settings.site_default_currency'),
                    'status' => 'completed'
                ];

                OrderPaymentUpdateEvent::dispatch($orderId,$paymentInfo,'Razorpay');
                OrderPlacedNotificationEvent::dispatch($orderId);
                RTOorderPlacedNotificationEvent::dispatch(Order::find($orderId));

                /** Clear Session  Data*/
                $orderService->clearSession();

                return redirect()->route('payment.success');
            }else{
                $this->transactionFailUpdateStatus('Razorpay');
                return redirect()->route('payment.cancel')->withErrors($e->getMessage());
            }
        }
    }

    public function transactionFailUpdateStatus($gatewayName): void
    {
        $orderId = session()->get('order_id');
        $paymentInfo = [
            'transaction_id' => '',
            'currency' => '',
            'status' => 'Failed'
        ];

            OrderPaymentUpdateEvent::dispatch($orderId,$paymentInfo,$gatewayName);
    }

}
