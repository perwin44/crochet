<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CardsController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CheckOutController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
// Route::get('/',function(){
//     return view('welcome');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::group(['middleware'=>['verified']],function(){
    Route::get('/dashboard', [UserDashboardController::class,'index'])->name('dashboard');
   
 /** User Profile Route */
 Route::get('profileuser', [UserProfileController::class, 'index'])->name('profileuser'); 
 Route::put('profileupdate', [UserProfileController::class, 'updateProfile'])->name('updateuser.profile'); 
 Route::post('profilepassword', [UserProfileController::class, 'updatePassword'])->name('passworduser.update');

 /** User Address Route */
Route::resource('address', UserAddressController::class);

/** Checkout routes */
Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address.create');
Route::post('checkout/form-submit', [CheckOutController::class, 'checkOutFormSubmit'])->name('checkout.form-submit');

 /** Payment Routes */
 Route::get('payment', [PaymentController::class, 'index'])->name('payment');
 Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

 /** Stripe routes */
 Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');

 /** COD routes */
 Route::get('cod/payment', [PaymentController::class, 'payWithCod'])->name('cod.payment');

  /** Order Routes */
  Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
  Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');


});


/** Cart routes */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
// Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-product-total');



/** Product route */
Route::get('productfront', [FrontendProductController::class, 'productsIndex'])->name('products.indexfront');
Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
//Route::get('change-product-list-view', [FrontendProductController::class, 'changeListView'])->name('change-product-list-view');

















/** Admin Route */
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['role:admin'])->name('admin.dashboard');

/** Profile Admin Routes */
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('update.profile');
Route::post('profilepass', [ProfileController::class, 'updatePassword'])->name('passwordup');

/** Slider Admin Route */
Route::resource('slider', SliderController::class);


/** Cards Admin Route */
Route::put('change-statuscard', [CardsController::class, 'changeStatus'])->name('card.change-status');
Route::resource('card', CardsController::class);


/** Banners Admin Route */
Route::put('change-statusbanner', [BannerController::class, 'changeStatus'])->name('banner.change-status');
Route::resource('banner', BannerController::class);


/** Category Admin Route */
Route::put('change-statuscategory', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);


/** Products Admin routes */
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);


/** Products Admin image gallery route */
Route::resource('products-image-gallery', ProductImageGalleryController::class);


/** Products Admin variant route */
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);


/** Products Admin variant item route */
Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');

Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');

Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');

Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');

Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');

Route::put('products-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.changes-status');



/** Admin settings routes */
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('generale-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('generale-setting-update');
Route::put('email-setting-update', [SettingController::class, 'emailConfigSettingUpdate'])->name('email-setting-update');
Route::put('logo-setting-update', [SettingController::class, 'logoSettingUpdate'])->name('logo-setting-update');
Route::put('pusher-setting-update', [SettingController::class, 'pusherSettingUpdate'])->name('pusher-setting-update');


/** shipping Rule Admin Routes */
Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule', ShippingRuleController::class);


/** Payment settings routes */
Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');
//Route::put('cod-setting/{id}', [CodSettingController::class, 'update'])->name('cod-setting.update');


/** Order routes */
Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');
Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');

Route::get('pending-orders', [OrderController::class, 'pendingOrders'])->name('pending-orders');
//Route::get('processed-orders', [OrderController::class, 'processedOrders'])->name('processed-orders');
//Route::get('dropped-off-orders', [OrderController::class, 'droppedOfOrders'])->name('dropped-off-orders');

Route::get('shipped-orders', [OrderController::class, 'shippedOrders'])->name('shipped-orders');
//Route::get('out-for-delivery-orders', [OrderController::class, 'outForDeliveryOrders'])->name('out-for-delivery-orders');
Route::get('delivered-orders', [OrderController::class, 'deliveredOrders'])->name('delivered-orders');
Route::get('canceled-orders', [OrderController::class, 'canceledOrders'])->name('canceled-orders');
Route::resource('order', OrderController::class);


/** Order Transaction route */
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');


/** home page setting route */
Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting');
Route::put('trending-products-section', [HomePageSettingController::class, 'updateTrendingProductsSection'])->name('trending-products-section');

Route::put('best-selling-section', [HomePageSettingController::class, 'BestSelling'])->name('best-selling-section');
Route::put('product-slider-section-two', [HomePageSettingController::class, 'updateProductSliderSectionTwo'])->name('product-slider-section-two');
Route::put('product-slider-section-three', [HomePageSettingController::class, 'updateProductSliderSectionThree'])->name('product-slider-section-three');
