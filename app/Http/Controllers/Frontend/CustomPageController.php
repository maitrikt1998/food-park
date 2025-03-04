<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomPageBuilder;
use Illuminate\Http\Request;

class CustomPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $slug)
    {
        $page = CustomPageBuilder::where(['slug'=> $slug, 'status'=> 1])->firstOrFail();
        return view('frontend.pages.custom-page',compact('page'));
    }
}
