@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Payment Gateway</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Gateway</h4>
          </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-2">
                  <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#paypal-setting" role="tab" aria-controls="home" aria-selected="true">Paypal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab4" data-toggle="tab" href="#stripe-setting" role="tab" aria-controls="home" aria-selected="true">Stripe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab4" data-toggle="tab" href="#razorpay-setting" role="tab" aria-controls="home" aria-selected="true">Stripe</a>
                    </li>
                  </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-10">
                  <div class="tab-content no-padding" id="myTab2Content">
                    @include('admin.payment-setting.section.paypal')

                    @include('admin.payment-setting.section.stripe')

                    @include('admin.payment-setting.section.razorpay')
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
</div>
@endsection
