<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
//use Gloudemans\Shoppingcart\Cart;
//use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartDetails()
    {
        $cartItems = Cart::content();

        if(count($cartItems) === 0){
            //Session::forget('coupon');
            toastr('Please add some products in your cart for view the cart page', 'warning');
            return redirect()->route('home');
        }

        // $cartpage_banner_section = Adverisement::where('key', 'cartpage_banner_section')->first();
        // $cartpage_banner_section = json_decode($cartpage_banner_section?->value);

        return view('frontend.pages.cart-detail', compact('cartItems'));
    }

    /** Add item to cart */
    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);

        // check product quantity
        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Product stock out']);
        }elseif($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

        $variants = [];
        $variantTotalAmount = 0;

        if($request->has('variants_items')){
            foreach($request->variants_items as $item_id){
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }


        /** check discount */
        $productPrice = 0;

        if(checkDiscount($product)){
            $productPrice = $product->offer_price;
        }else {
            $productPrice = $product->price;
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->image;
        $cartData['options']['slug'] = $product->slug;

        Cart::add($cartData);

        return response(['message' =>'Added to cart successfully!','status' => 'success']);
    }


    /** Update product quantity */
    public function updateProductQty(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        // check product quantity
        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Product stock out']);
        }elseif($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);

        return response(['status' => 'success', 'message' => 'Product Quantity Updated!', 'product_total' => $productTotal]);
    }

    /** get product total */
    public function getProductTotal($rowId)
    {
       $product = Cart::get($rowId);
       $total = ($product->price + $product->options->variants_total) * $product->qty;
       return $total;
    }

    /** get cart total amount */
    public function cartTotal()
    {
        $total = 0;
        foreach(Cart::content() as $product){
            $total += $this->getProductTotal($product->rowId);
        }

        return $total;
    }

    /** clear all cart products */
    public function clearCart()
    {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Cart cleared successfully']);
    }

    /** Remove product form cart */
    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Product removed succesfully!', 'success');
        return redirect()->back();
    }

    /** Get cart count */
    public function getCartCount()
    {
        return Cart::content()->count();
    }

    /** Get all cart products */
    public function getCartProducts()
    {
        return Cart::content();
    }

    /** Romve product form sidebar cart */
    // public function removeSidebarProduct(Request $request)
    // {
    //     Cart::remove($request->rowId);

    //     return response(['status' => 'success', 'message' => 'Product removed successfully!']);
    // }

    /** Apply coupon */
   

}
