<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGatewaySetting;
use App\Services\PaymentGatewaySettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentGatewaySettingController extends Controller
{
    use FileUploadTrait;
    public function index() : View
    {
        $paymentGateway = PaymentGatewaySetting::pluck('value','key');
        return view('admin.payment-setting.index',compact('paymentGateway'));
    }

    public function paypalSettingUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'paypal_status' => ['required', 'boolean'],
            'paypal_account_mode' => ['required', 'in:sandbox,live'],
            'paypal_country' => ['required'],
            'paypal_currency' => ['required'],
            'paypal_rate' => ['required', 'numeric'],
            'paypal_api_key' => ['required'],
            'paypal_secret_key' => ['required'],
            // 'paypal_app_id' => ['required'],
        ]);

        if($request->hasFile('paypal_logo')){
            $request->validate([
                'paypal_logo' => ['nullable', 'image']
            ]);

            $imagePath = $this->uploadImage($request,'paypal_logo');

            PaymentGatewaySetting::updateOrCreate(
                ['key' => 'paypal_logo'],
                ['value' => $imagePath],
            );
        }

        foreach($validatedData as $key => $value)
        {
            PaymentGatewaySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }
        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCachedSettings();
        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }

    public function stripeSettingUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'stripe_status' => ['required', 'boolean'],
            // 'paypal_account_mode' => ['required', 'in:sandbox,live'],
            'stripe_country' => ['required'],
            'stripe_currency' => ['required'],
            'stripe_rate' => ['required', 'numeric'],
            'stripe_api_key' => ['required'],
            'stripe_secret_key' => ['required'],
            // 'paypal_app_id' => ['required'],
        ]);

        if($request->hasFile('stripe_logo')){
            $request->validate([
                'stripe_logo' => ['nullable', 'image']
            ]);

            $imagePath = $this->uploadImage($request,'stripe_logo');

            PaymentGatewaySetting::updateOrCreate(
                ['key' => 'stripe_logo'],
                ['value' => $imagePath],
            );
        }

        foreach($validatedData as $key => $value)
        {
            PaymentGatewaySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }
        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCachedSettings();
        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }


    public function razorpaySettingUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'razorpay_status' => ['required', 'boolean'],
            'razorpay_country' => ['required'],
            'razorpay_currency' => ['required'],
            'razorpay_rate' => ['required', 'numeric'],
            'razorpay_api_key' => ['required'],
            'razorpay_secret_key' => ['required'],
        ]);

        if($request->hasFile('razorpay_logo')){
            $request->validate([
                'razorpay_logo' => ['nullable', 'image']
            ]);

            $imagePath = $this->uploadImage($request,'razorpay_logo');

            PaymentGatewaySetting::updateOrCreate(
                ['key' => 'razorpay_logo'],
                ['value' => $imagePath],
            );
        }

        foreach($validatedData as $key => $value)
        {
            PaymentGatewaySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }
        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCachedSettings();
        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }


}
