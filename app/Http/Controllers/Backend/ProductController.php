<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'long_description' => ['required'],
            'status' => ['required']
        ]);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $product = new Product();
        $product->image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category;
        $product->qty = $request->qty;
        $product->long_description = strip_tags($request->long_description);
        $product->video_link = $request->video_link;
        $product->sku1 = $request->sku1;
        $product->sku2 = $request->sku2;
        $product->sku3 = $request->sku3;
        $product->sku4 = $request->sku4;
        $product->sku5 = $request->sku5;
        $product->sku6 = $request->sku6;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->save();

        //dd($request);
        toastr('Created Successfully!', 'success');

        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'long_description' => ['required'],
            'status' => ['required']
        ]);

        $product = Product::findOrFail($id);

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'image', 'uploads', $product->image);

        $product->image = empty(!$imagePath) ? $imagePath : $product->image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category;
        $product->qty = $request->qty;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku1 = $request->sku1;
        $product->sku2 = $request->sku2;
        $product->sku3 = $request->sku3;
        $product->sku4 = $request->sku4;
        $product->sku5 = $request->sku5;
        $product->sku6 = $request->sku6;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        // if(OrderProduct::where('product_id',$product->id)->count() > 0){
        //     return response(['status' => 'error', 'message' => 'This product have orders can\'t delete it.']);
        // }

        /** Delte the main product image */
        $this->deleteImage($product->image);

        /** Delete product gallery images */
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($galleryImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        // /** Delete product variants if exist */
        $variants = ProductVariant::where('product_id', $product->id)->get();

        foreach($variants as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }

    

 

}
