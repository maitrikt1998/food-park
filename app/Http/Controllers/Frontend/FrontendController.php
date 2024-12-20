<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\SectionTitle;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
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
        return view('frontend.home.index',compact('sliders','sectionTitles', 'whyChooseUs', 'categories'));
    }

    function getSectionTitle() : Collection
    {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title'
        ];
        return SectionTitle::whereIn('key',$keys)->pluck('value','key');
    }

    function showProduct(string $slug) : View
    {
        $product = Product::with(['productImages', 'productSize', 'productOption'])
            ->where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->take(8)->latest()->get();
        return view('frontend.pages.product-view',compact('product','relatedProducts'));
    }
}
