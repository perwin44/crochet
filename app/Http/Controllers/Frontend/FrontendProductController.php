<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{
    public function productsIndex(Request $request)
    {
     
      if($request->has('category')){
        $category = Category::where('slug', $request->category)->firstOrFail();
        $products = Product::with(['variants', 'category', 'productImageGalleries'])
        ->where([
            'category_id' => $category->id,
            'status' => 1,
            'is_approved' => 1
        ])
       
        ->paginate(12);
    }else{
      $products = Product::where(['status' => 1, 'is_approved' => 1])->orderBy('id', 'DESC')->paginate(12);
    }
    $categories = Category::where(['status' => 1])->get();
        return view('frontend.pages.product', compact( 'categories','products'));
    }
   
    /** Show product detail page */
    public function showProduct(string $slug)
    {
        $product = Product::with([ 'category', 'productImageGalleries', 'variants'])->where('slug', $slug)->where('status', 1)->first();
       
        return view('frontend.pages.product-detail', compact('product'));
    }

    // public function changeListView(Request $request)
    // {
    //    Session::put('product_list_style', $request->style);
    // }
}
