<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\AppDownloadSection;
use App\Models\BannerSlider;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\Coupon;
use App\Models\DailyOffer;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\Reservation;
use App\Models\SectionTitle;
use App\Models\TermsAndCondition;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use App\Models\Subscriber;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

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
        $latestBlogs = Blog::withCount(['comments'=> function($query){
            $query->where('status', 1);
        }])->with(['user','category'])->where(['status' => 1])->latest()->take(3)->get();
        return view('frontend.home.index',compact('sliders','sectionTitles', 'whyChooseUs', 'categories','dailyOffers','bannerSliders','chefs','appSection','testimonials','counter','latestBlogs'));
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

    function blogs(Request $request) : View
    {
        $blogs = Blog::withCount(['comments' => function($query){
            $query->where('status', 1);
        }])->with(['user','category'])->where('status', 1);

        if($request->has('search') && $request->filled('search')){
            $blogs->where(function($query) use($request){
                $query->where('title','like','%'.$request->search.'%')
                ->orWhere('description','like','%'.$request->search.'%');
            });
        }

        if($request->has('category') && $request->filled('category')){
            $blogs->whereHas('category', function($query) use($request){
                $query->where('slug', $request->category);
            });
        }

        $blogs = $blogs->latest()->paginate(9);
        $categories = BlogCategory::where('status',1)->get();
        return view('frontend.pages.blog',compact('blogs','categories'));
    }

    function blogDetails(string $slug) : View
    {
        $blog = Blog::with(['user'])->where('slug', $slug)->where('status', 1)->firstOrFail();
        $comments = $blog->comments()->where('status', 1)->orderBy('id','DESC')->paginate(20);
        $latestBlogs = Blog::select('id','slug','title','created_at','image')->where('status', 1)
                        ->where('id','!=',$blog->id)->latest()->take(5)->get();
        $categories = BlogCategory::withCount(['blogs'=> function($query){
            $query->where('status', 1);
        }])->where('status',1)->get();

        $previousBlog = Blog::select('id','slug','title','image')->where('id','<',$blog->id)->orderBy('id','ASC')->first();
        $nextBlog = Blog::select('id','slug','title','image')->where('id','>',$blog->id)->orderBy('id','DESC')->first();
        return view('frontend.pages.blog-details',compact('blog','latestBlogs','categories','previousBlog','nextBlog', 'comments'));
    }

    function blogCommentStore(Request $request, String $blog_id): RedirectResponse
    {
        $request->validate([
            'comment' => ['required', 'max:500']
        ]);

        Blog::findOrFail($blog_id);

        $comment = new BlogComment();
        $comment->blog_id = $blog_id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        toastr()->success("Comment Submitted Successfully and waiting to approve.");
        return redirect()->back();
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

    function contact()
    {
        $contact = Contact::first();
        return view('frontend.pages.contact',compact('contact'));
    }

    function sendContactMessage(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:255'],
            'message' => ['required', 'max:1000'],
        ]);

        Mail::send(new ContactMail($request->name, $request->email, $request->subject, $request->message));
        return response(['status' => 'success', 'message' => 'Message send Successfully!']);
    }
    function subscribeNewsletter(Request $request): Response
    {
        $request->validate([
            'email'=> ['required','email','max:255','unique:subscribers,email']
        ],[
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email is already SUbscribed!',
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        return response(['status' => 'success', 'message' => 'Subscribed Successfully!']);
    }

    function reservation(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'phone' => ['required', 'max:50'],
            'date' => ['required',  'date'],
            'time' => ['required'],
            'person' => ['required', 'numeric'],
        ]);

        if(!Auth::check()){
            throw ValidationException::WithMessages([
               "Please Login to Request Reservation!"
            ]);
        }
        $reservation = new Reservation();
        $reservation->reservation_id = rand(0,5000);
        $reservation->user_id = auth()->user()->id;
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->persons = $request->person;
        $reservation->status = 'pending';
        $reservation->save();

        return response(['status' => 'success', 'message' => 'Reservation send Successfully!']);
    }

    function products(Request $request) : View
    {

        $products = Product::where(['status' => 1])->orderBy('id','DESC');

        if($request->has('search') && $request->filled('search')){
            $products->where(function($query) use($request){
                $query->where('name','like','%'.$request->search.'%')
                ->orWhere('long_description','like','%'.$request->search.'%');
            });
        }

        if($request->has('category') && $request->filled('category')){
            $products->whereHas('category', function($query) use($request){
                $query->where('slug', $request->category);
            });
        }

        $products->withAvg('reviews', 'rating')
            ->withCount('reviews')->paginate(12);

        $categories = Category::where('status', 1)->get();
        return view('frontend.pages.products', compact('products','categories'));
    }
    function showProduct(string $slug) : View
    {
        $product = Product::with(['productImages', 'productSize', 'productOption'])
            ->where(['slug' => $slug, 'status' => 1])
            ->withAvg('reviews','rating')
            ->withCount('reviews')
            ->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->withAvg('reviews','rating')
            ->withCount('reviews')
            ->take(8)->latest()->get();
        $reviews = ProductRating::where(['product_id' => $product->id, 'status' => 1])->paginate(30);
        return view('frontend.pages.product-view',compact('product', 'relatedProducts', 'reviews'));
    }

    function loadProductModal($productId){
        $product = Product::with(['productSize','productOption'])->findOrFail($productId);
        return view('frontend.layouts.ajax-files.product-popup-modal',compact('product'))->render();
    }

    function productReviewStore(Request $request)
    {
        $request->validate([
            'rating' => ['required', 'min:1', 'max:5', 'integer'],
            'review' => ['required', 'max:500'],
            'product_id' => ['required' , 'integer']
        ]);

        $user = Auth::user();

        $hasPurchased = $user->orders()->whereHas('orderItems',function($query) use($request){
            $query->where('product_id',$request->product_id);
        })->where('order_status','delivered')->get();

        if(count($hasPurchased) == 0){
            throw ValidationException::withMessages(['Please Buy The Product Before Submit a Review!']);
        }

        $alreadyReviewed =  ProductRating::where(['user_id' =>  $user->id, 'product_id' => $request->product_id])->exists();

        if($alreadyReviewed){
            throw ValidationException::withMessages(['You already Reviewed this product!']);
        }

        $review = new ProductRating();
        $review->user_id = $user->id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->status = 0;
        $review->save();

        toastr()->success("Review added successfully and waiting to approve!");
        return redirect()->back();
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
