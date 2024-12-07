<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SectionTitle;
use App\Models\WhyChooseUs;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $sectionTitles = $this->getSectionTitle();

        $sliders = Slider::where('status',1)->get();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();
        return view('frontend.home.index',compact('sliders','sectionTitles', 'whyChooseUs'));
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
}
