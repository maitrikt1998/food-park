<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentGatewaySettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\AppDownloadSectionController;
use App\Http\Controllers\Admin\BannerSliderController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
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
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\ClearDatabaseController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DailyOfferController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\MenuBuilderController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ReservationTimeController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CustomPageBuilderController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Models\SocialLink;
use Efectn\Menu\Facades\Menu;

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

     /** Admin Management Routes */
     Route::resource('admin-management', AdminManagementController::class);

     /** Product Review Routes */
     Route::get('product-reviews',[ProductReviewController::class, 'index'])->name('product-reviews.index');
     Route::post('product-reviews',[ProductReviewController::class, 'updateStatus'])->name('product-reviews.update');
     Route::delete('product-reviews/{id}',[ProductReviewController::class, 'destroy'])->name('product-reviews.destroy');

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

     /** Daily Offer Routes */
    Route::get('daily-offer/product-search',[DailyOfferController::class,'productSearch'])->name('daily-offer.search-product');
    Route::put('daily-offer-title-update',[DailyOfferController::class, 'updateTitle'])->name('daily-offer-title.update');
    Route::put('chefs-title-update',[ChefController::class, 'updateTitle'])->name('chef-title.update');
    Route::resource('daily-offer', DailyOfferController::class);

    /** Banner Slider Routes */
    Route::resource('banner-slider', BannerSliderController::class);

    /** Chef Routes */
    Route::resource('chefs', ChefController::class);

    /** App Download Routes */
    Route::get('app-download',[AppDownloadSectionController::class,'index'])->name('app-download.index');
    Route::post('app-download', [AppDownloadSectionController::class,'store'])->name('app-download.store');

    /** Testimonial Routes */
    Route::put('testimonial-title-update',[TestimonialController::class, 'updateTitle'])->name('testimonial-title.update');
    Route::resource('testimonial', TestimonialController::class);

    /** Counter Routes */
    Route::get('counter', [CounterController::class,'index'])->name('counter.index');
    Route::put('counter', [CounterController::class,'update'])->name('counter.update');

    /** About Routes */
    Route::get('/about', [AboutController::class,'index'])->name('about.index');
    Route::put('/about', [AboutController::class,'update'])->name('about.update');

    /** Blog Routes */
    Route::get('/blogs/comments', [BlogController::class,'blogComment'])->name('blog.comment');
    Route::get('/blogs/comments/{id}', [BlogController::class,'commentStatusUpdate'])->name('blog.comments.update');
    Route::delete('/blogs/comments/{id}', [BlogController::class,'commentsDestroy'])->name('blog.comments.delete');
    Route::resource('blogs', BlogController::class);
    Route::resource('blog-category', BlogCategoryController::class);

    /** Privacy Policy Routes */
    Route::get('/privacy-policy', [PrivacyPolicyController::class,'index'])->name('privacy-policy.index');
    Route::put('/privacy-policy', [PrivacyPolicyController::class,'update'])->name('privacy-policy.update');

    /** terms and condition  Routes */
    Route::get('/terms-and-condition', [TermsAndConditionController::class,'index'])->name('terms-and-condition.index');
    Route::put('/terms-and-condition', [TermsAndConditionController::class,'update'])->name('terms-and-condition.update');

     /** terms and condition  Routes */
     Route::get('/contact', [ContactController::class,'index'])->name('contact.index');
     Route::put('/contact', [ContactController::class,'update'])->name('contact.update');

     Route::resource('reservation-time', ReservationTimeController::class);
     Route::get('reservation', [ReservationController::class,'index'])->name('reservation.index');
     Route::post('reservation', [ReservationController::class,'update'])->name('reservation.update');
     Route::delete('reservation/{id}', [ReservationController::class,'destroy'])->name('reservation.delete');

    /** Social Link  Routes */
    Route::resource('social-link', SocialLinkController::class);

    /** Footer Info Routes */
    Route::get('footer-info', [FooterInfoController::class,'index'])->name('footer-info.index');
    Route::put('footer-info', [FooterInfoController::class,'update'])->name('footer-info.update');

    /** Menu builder Routes */
    Route::get('menu-builder', [MenuBuilderController::class,'index'])->name('menu-builder.index');
    Route::resource('custom-page-builder', CustomPageBuilderController::class);
     /** News Letter  Routes */
     Route::get('news-letter', [NewsLetterController::class,'index'])->name('news-letter.index');
     Route::post('news-letter', [NewsLetterController::class,'sendNewsLetter'])->name('news-letter.send');

    /** Payment Gateway setting Routes */
    Route::get('payment-gateway-setting', [PaymentGatewaySettingController::class,'index'])->name('payment-setting.index');
    Route::put('paypal-setting', [PaymentGatewaySettingController::class,'paypalSettingUpdate'])->name('paypal-setting.update');
    Route::put('stripe-setting', [PaymentGatewaySettingController::class,'stripeSettingUpdate'])->name('stripe-setting.update');
    Route::put('razorpay-setting', [PaymentGatewaySettingController::class,'razorpaySettingUpdate'])->name('razorpay-setting.update');

     /** Setting Routes */
    Route::get('setting', [SettingController::class,'index'])->name('setting.index');
    Route::put('general-setting', [SettingController::class,'updateGeneralSetting'])->name('general-setting.update');
    Route::put('pusher-setting', [SettingController::class,'updatePusherSetting'])->name('pusher-setting.update');
    Route::put('mail-setting', [SettingController::class,'updateMailSetting'])->name('mail-setting.update');
    Route::put('logo-setting', [SettingController::class,'updateLogoSetting'])->name('logo-setting.update');
    Route::put('appearance-setting', [SettingController::class,'updateAppearanceSetting'])->name('appearance-setting.update');
    Route::put('seo-setting', [SettingController::class,'updateSeoSetting'])->name('seo-setting.update');

    Route::get('/clear-database',[ClearDatabaseController::class,'index'])->name('clear-database.index');
    Route::post('/clear-database',[ClearDatabaseController::class,'clearDB'])->name('clear-database.destroy');


});
