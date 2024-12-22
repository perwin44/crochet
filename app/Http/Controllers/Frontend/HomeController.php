<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Card;
use App\Models\Category;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $sliders =Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $cards =Card::where('status', 1)->get();
        $banners =Banner::where('status', 1)->get();
        $product=Product::where('status', 1)->get();
        $trendingProducts=HomePageSetting::where('key','trending_products_section')->first();
        
        return view('frontend.home.home',compact(
            'sliders',
            'cards',
            'banners',
            'product',
            'trendingProducts',
            
        ));
    }
}
