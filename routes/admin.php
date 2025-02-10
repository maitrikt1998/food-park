<?php

use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentGatewaySettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\ChatController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /* Profile Routes */
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::put('/profile',[ProfileController::class,'updateProfile'])->name('profile.update');
    Route::put('/profile/password',[ProfileController::class,'updatePassword'])->name('profile.password.update');

    /* Slider Routes */
    Route::resource('slider', SliderController::class);

    /* Why Choose us Routes */
    Route::put('why-choose-title-update',[WhyChooseUsController::class, 'updateTitle'])->name('why-choose-title.update');
    Route::resource('why-choose-us', WhyChooseUsController::class);


    /* Product Category Routes */
    Route::resource('category', CategoryController::class);

    /** Product Routes */
    Route::resource('product', ProductController::class);

    /** Product Gallery Routes */
    Route::get('product-gallery/{product}',[ProductGalleryController::class, 'index'])->name('product-gallery.show-index');
    Route::resource('product-gallery', ProductGalleryController::class);

     /** Product Size Routes */
     Route::get('product-size/{product}',[ProductSizeController::class, 'index'])->name('product-size.show-index');
     Route::resource('product-size', ProductSizeController::class);

     /** Product option Routes */
     Route::resource('product-option', ProductOptionController::class);

     /** Coupon Routes */
     Route::resource('coupon', CouponController::class);

     /** Delivery Area Routes */
     Route::resource('delivery-area', DeliveryAreaController::class);

     /** Order Routes */
     Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
     Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
     Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

     Route::get('pending-orders', [OrderController::class, 'pendingorderIndex'])->name('pending-orders');
     Route::get('inprocess-orders', [OrderController::class, 'inProcessorderIndex'])->name('inprocess-orders');
     Route::get('delivered-orders', [OrderController::class, 'deliveredorderIndex'])->name('delivered-orders');
     Route::get('declined-orders', [OrderController::class, 'declineddorderIndex'])->name('declined-orders');

     Route::get('orders/status/{id}', [OrderController::class, 'getOrderStatus'])->name('orders.status');
     Route::put('orders/status-update/{id}', [OrderController::class, 'orderStatusUpdate'])->name('orders.status-update');

     /** Order Notification Routes */
     Route::get('clear-notification',[AdminDashboardController::class,'clearNotification'])->name('clear-notification');

     /** Chat Routes */
     Route::get('chat',[ChatController::class,'index'])->name('chat.index');
     Route::get('get-conversation/{userId}', [ChatController::class, 'getConversation'])->name('chat.get-conversation');
     Route::post('chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');
     /** Payment Gateway setting Routes */
    Route::get('payment-gateway-setting', [PaymentGatewaySettingController::class,'index'])->name('payment-setting.index');
    Route::put('paypal-setting', [PaymentGatewaySettingController::class,'paypalSettingUpdate'])->name('paypal-setting.update');
    Route::put('stripe-setting', [PaymentGatewaySettingController::class,'stripeSettingUpdate'])->name('stripe-setting.update');
    Route::put('razorpay-setting', [PaymentGatewaySettingController::class,'razorpaySettingUpdate'])->name('razorpay-setting.update');

     /** Setting Routes */
    Route::get('setting', [SettingController::class,'index'])->name('setting.index');
    Route::put('general-setting', [SettingController::class,'updateGeneralSetting'])->name('general-setting.update');
    Route::put('pusher-setting', [SettingController::class,'updatePusherSetting'])->name('pusher-setting.update');


});
