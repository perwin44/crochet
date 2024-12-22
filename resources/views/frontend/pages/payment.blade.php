@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name}} || Payment
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->

    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                {{-- <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                    aria-selected="true">card payment</button> --}}

                               

                                <button style="color: black" class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-stripe" type="button" role="tab"
                                    aria-controls="v-pills-stripe" aria-selected="false">Credit Card</button>

                               

                                <button style="color: black" class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-cod" type="button" role="tab"
                                aria-controls="v-pills-stripe" aria-selected="false">COD</button>


                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
  

                           

                            @include('frontend.pages.payment-gateway.stripe')


                            @include('frontend.pages.payment-gateway.cod')



                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Order Summary</h5>
                            <p>subtotal : <span>{{'$'}}{{getCartTotal()}}</span></p>
                            <p>shipping fee(+) : <span>{{'$'}}{{getShppingFee()}}</span></p>
                            {{-- <p>coupon(-) : <span>{{$settings->currency_icon}}{{getCartDiscount()}}</span></p> --}}
                            <h6>total <span>{{'$'}}{{getFinalPayableAmount()}}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->
@endsection
