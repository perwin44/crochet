<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $trendingProductsSection = HomePageSetting::where('key', 'trending_products_section')->first();
        $bestSelling = HomePageSetting::where('key', 'best_selling_section')->first();
        //$sliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        //$sliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();

        return view('admin.home-page-setting.index', compact('categories', 'trendingProductsSection','bestSelling'));
    }

    public function updateTrendingProductsSection(Request $request){
        $request->validate([
            //'cat' => ['required'],
            'cat_one' => ['required'],
            'cat_two' => ['required'],
            'cat_three' => ['required'],
            'cat_four' => ['required']

        ], [
            //'cat.required' => 'All Categories filed is required',
            'cat_one.required' => 'Category one filed is required',
            'cat_two.required' => 'Category two filed is required',
            'cat_three.required' => 'Category three filed is required',
            'cat_four.required' => 'Category four filed is required',
        ]);

        // dd($request->all());
        $data = [
           
            [
                'category' => $request->cat_one,
            
            ],
            [
                'category' => $request->cat_two,
               
            ],
            [
                'category' => $request->cat_three,
                
            ],
            [
                'category' => $request->cat_four,
                
            ]
        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'trending_products_section'
            ],
            [
                'value' => json_encode($data)
            ]
        );

        toastr('Updated successfully!', 'success');

        return redirect()->back();
    }

    public function BestSelling(Request $request){

        $request->validate([
            'cat_one' => ['required']
        ], [
            'cat_one.required' => 'Category filed is required'
        ]);

        $data = [
                'category' => $request->cat_one,
                
            ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'best_selling_section'
            ],
            [
                'value' => json_encode($data)
            ]
        );

        toastr('Updated successfully!', 'success');

        return redirect()->back();

    }

    }

