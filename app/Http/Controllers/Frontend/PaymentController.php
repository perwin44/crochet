<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;


class PaymentController extends Controller
{
    function index()
    {
        if(!Session::has('address')){
            return redirect()->route('checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    public function storeOrder($paymentMethod, $paymentStatus, $transactionId)
    {
        $setting = GeneralSetting::first();

        $order = new Order();
        $order->invoice_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->sub_total = getCartTotal();
        $order->amount =  getFinalPayableAmount();
        $order->product_qty = \Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->order_status = 'pending';
        $order->save();

        // store order products
        foreach(\Cart::content() as $item){
            $product = Product::find($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variants_total;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();

            // update product quantity
            $updatedQty = ($product->qty - $item->qty);
            $product->qty = $updatedQty;
            $product->save();
        }

        // store transaction details
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = getFinalPayableAmount();
       
        $transaction->save();

    }

    public function clearSession()
    {
        \Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        //Session::forget('coupon');
    }

/** Stripe Payment */

public function payWithStripe(Request $request)
{

    // calculate payable amount depending on currency rate
     $stripeSetting = StripeSetting::first();
    // $total = getFinalPayableAmount();
    // $payableAmount = round($total , 2);

    Stripe::setApiKey($stripeSetting->secret_key);
   $response = Charge::create([
        "amount" => getFinalPayableAmount() * 100,
        "currency"=>"usd",
        "source" => $request->stripe_token,
        "description" => "product purchase!"
    ]);
    

    if($response->status === 'succeeded'){
        $this->storeOrder('stripe', 1, $response->id);
        // clear session
        $this->clearSession();
        
        return redirect()->route('payment.success');
    }else {
        toastr('Someting went wrong try agin later!', 'error');
        return redirect()->route('payment');
    }

}



/** pay with cod */
// public function payWithCod(Request $request)
// {
//     $codPaySetting = CodSetting::first();
//     $setting = GeneralSetting::first();
//     if($codPaySetting->status == 0){
//         return redirect()->back();
//     }

//     // amount calculation
//    $total = getFinalPayableAmount();
//    $payableAmount = round($total, 2);


//     $this->storeOrder('COD', 0, \Str::random(10), $payableAmount, $setting->currency_name);
//     // clear session
//     $this->clearSession();

//     return redirect()->route('payment.success');
        

// }
}
