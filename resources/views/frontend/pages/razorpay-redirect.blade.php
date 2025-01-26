<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .razorpay-payment-button{
            display: none;
        }
    </style>
</head>
<body>
    @php
        $grandTotal = session()->get('grand_total');
        $payableAmount = ($grandTotal * config('gatewaySettings.razorpay_rate')) * 100
    @endphp
    <form action="{{ route('razorpay.payment') }}" method="POST">
        @csrf
        <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{ config('gatewaySettings.razorpay_api_key') }}"
            data-currency="{{ config('gatewaySettings.razorpay_currency') }}"
            data-amount="{{ session()->get('grand_total') }}"
            data-buttontext="Pay"
            data-name="Payment"
            data-description="Payment for product"
            data-prefill.name="John"
            data-prefill.email="test@gmail.com"
            data-theme.color="#ff7529"
        ></script>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            var button = document.querySelector(".razorpay-payment-button");
            button.click();
        });
    </script>
</body>
</html>
