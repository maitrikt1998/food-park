<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AppDownloadSection;
use App\Models\BannerSlider;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Counter;
use App\Models\Coupon;
use App\Models\DailyOffer;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\SectionTitle;
use App\Models\TermsAndCondition;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $sectionTitles = $this->getSectionTitle();
        $sliders = Slider::where('status',1)->get();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();

        $categories = Category::where(['show_at_home' => 1, 'status' => 1])->get();
        $dailyOffers = DailyOffer::with('product')->where('status',1)->take(15)->get();
        $bannerSliders = BannerSlider::where('status', 1)->latest()->take(10)->get();
        $chefs = Chef::where(['show_at_home' => 1, 'status' => 1])->get();
        $appSection = AppDownloadSection::first();
        $testimonials = Testimonial::where(['show_at_home' => 1, 'status' => 1])->get();
        $counter = Counter::first();
        return view('frontend.home.index',compact('sliders','sectionTitles', 'whyChooseUs', 'categories','dailyOffers','bannerSliders','chefs','appSection','testimonials','counter'));
    }

    function getSectionTitle() : Collection
    {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title',
            'daily_offer_top_title',
            'daily_offer_main_title',
            'daily_offer_sub_title',
            'chefs_top_title',
            'chefs_main_title',
            'chefs_sub_title',
            'testimonial_top_title',
            'testimonial_main_title',
            'testimonial_sub_title',
        ];
        return SectionTitle::whereIn('key',$keys)->pluck('value','key');
    }

    function chef()
    {
        $chefs = Chef::where(['status' => 1])->paginate(1);
        return view('frontend.pages.chef',compact('chefs'));
    }

    function testimonial()
    {
        $testimonials = Testimonial::where(['status' => 1])->paginate(9);
        return view('frontend.pages.testimonial',compact('testimonials'));
    }

    function about()
    {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title',
            'chefs_top_title',
            'chefs_main_title',
            'chefs_sub_title',
            'testimonial_top_title',
            'testimonial_main_title',
            'testimonial_sub_title',
        ];
        $sectionTitles = SectionTitle::whereIn('key',$keys)->pluck('value','key');

        $about = About::first();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();
        $chefs = Chef::where(['show_at_home' => 1, 'status' => 1])->get();
        $counter = Counter::first();
        $testimonials = Testimonial::where(['show_at_home' => 1, 'status' => 1])->get();

        return view('frontend/pages/about',compact('about', 'whyChooseUs', 'sectionTitles', 'chefs', 'counter', 'testimonials'));
    }

    function privacyPolicy()
    {
        $privacy_policy =  PrivacyPolicy::first();
        return view('frontend.pages.privacy-policy', compact('privacy_policy'));
    }

    function termsAndConditions()
    {
        $terms_condition =  TermsAndCondition::first();
        return view('frontend.pages.terms-and-condition', compact('terms_condition'));
    }

    function showProduct(string $slug) : View
    {
        $product = Product::with(['productImages', 'productSize', 'productOption'])
            ->where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->take(8)->latest()->get();
        return view('frontend.pages.product-view',compact('product','relatedProducts'));
    }

    function loadProductModal($productId){
        $product = Product::with(['productSize','productOption'])->findOrFail($productId);
        return view('frontend.layouts.ajax-files.product-popup-modal',compact('product'))->render();
    }

    function applyCoupon(Request $request){
        $subtotal = $request->subtotal;
        $code = $request->code;
        $coupon = Coupon::where('code',$code)->first();

        if(!$coupon){
            return response(['message'=> 'Invalid Coupon Code'],422);
        }
        if($coupon->quantity <= 0){
            return response(['message'=> 'Coupon has fully redeemed'],422);
        }
        if($coupon->expire_date < now()){
            return response(['message'=> 'Coupon has expired'],422);
        }

        if($coupon->discount_type === 'percent')
        {
            $discount = number_format($subtotal * ($coupon->discount / 100),2);
        }else if($coupon->discount_type === 'amount'){
            $discount = number_format($coupon->discount,2);
        }

        $finalTotal = $subtotal - $discount;

        session()->put('coupon',['code' => $code, 'discount' => $discount]);
        return response(['message' => 'Coupon Applied Successfully','discount'=> $discount, 'finalTotal' => $finalTotal, 'coupon_code' => $code ]);
    }

    function destroyCoupon()
    {
        try{
            session()->forget('coupon');
            return response(['message' => 'Coupon Removed!','grand_cart_total' => grandCartTotal()]);
        }catch(\Exception $e){
            logger($e);
            return response(['message' => 'Something went wrong!']);
        }
    }
}
