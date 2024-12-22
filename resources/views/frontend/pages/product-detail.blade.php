@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name}} || Product Details
@endsection

@section('content')


<div class="container mt-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6 mb-4 ">
            <img src="{{asset($product->image)}}" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
            <div class="d-flex justify-content-between">
                @if ($product->video_link)
                <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                    href="{{$product->video_link}}">
                    <i class="fa fa-play"></i>
                </a>
            @endif
                @foreach ($product->productImageGalleries as $productImage)
                <img src="{{asset($productImage->image)}}" alt="Thumbnail 1" class="thumbnail rounded active" onclick="changeImage(event, this.src)">
                {{-- <img src="{{asset($productImage->image)}}" alt="Thumbnail 2" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                <img src="{{asset($productImage->image)}}" alt="Thumbnail 3" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                <img src="{{asset($productImage->image)}}" alt="Thumbnail 4" class="thumbnail rounded" onclick="changeImage(event, this.src)"> --}}
                @endforeach
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3">{{$product->name}}</h2>
            @if ($product->qty > 0)
            <p class="wsus__stock_area"><span class="in_stock">in stock</span> ({{$product->qty}} item)</p>
            @elseif ($product->qty === 0)
            <p class="wsus__stock_area"><span class="out_stock">stock out</span> ({{$product->qty}} item)</p>
            @endif
            {{-- <p class="text-muted mb-4">SKU: WH1000XM4</p> --}}
            <div class="mb-3">
                
                <span class="h4 me-2">${{$product->offer_price}}</span>
                
                <span class="text-muted"><s>${{$product->price}}</s></span>
               
            </div>
            <div class="mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
                <span class="ms-2">4.5 (120 reviews)</span>
            </div>
            <p class="mb-4">{!! $product->long_description !!}</p>

            <form class="shopping-cart-form" >
                <div class="wsus__selectbox">
                    <div class="row">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        @foreach ($product->variants as $variant)
                        @if ($variant->status != 0)
                            <div class="col-4">
                                <h5 class="mb-2">{{$variant->name}}: </h5>
                                <select class="select_2" name="variants_items[]">
                                    @foreach ($variant->productVariantItems as $variantItem)
                                        @if ($variantItem->status != 0)
                                            <option value="{{$variantItem->id}}" {{$variantItem->is_default == 1 ? 'selected' : ''}}>{{$variantItem->name}} (${{$variantItem->price}})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @endforeach

                    </div>
                </div>
           
            {{-- <div class="mb-4 d-flex justify-content-between" >
            <input type="hidden" name="product_id" value="{{$product->id}}">
            @foreach ($product->variants as $variant)
            @if ($variant->status != 0)
            <h5>{{$variant->name}}:</h5>
            <div class="btn-group variant-group" role="group" aria-label="selection">
            @foreach ($variant->productVariantItems as $variantItem)
            @if ($variantItem->status != 0)
            <input type="radio" class="btn-check variant-item" 
                   id="variant-{{$variantItem->id}}" 
                   name="variants_items[{{$variant->id}}]" 
                   value="{{$variantItem->id}}" autocomplete="off">
                   
            <label class="btn btn-outline-success" for="variant-{{$variantItem->id}}">
                {{$variantItem->name}} (${{$variantItem->price}})
            </label>
        @endif
        @endforeach
    </div>
@endif
@endforeach

</div> --}}
        
            <div class="mb-4">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" name="qty" class="form-control" id="quantity" value="1" min="1" style="width: 80px;">
            </div>
            <button type="submit" class="btn btn-primary btn-lg mb-3 me-2">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
            <button class="btn btn-outline-danger btn-lg  mb-3">
                    <i class="bi bi-heart"></i> Add to Wishlist
                </button>
            </form>
            {{-- <div class="mt-4">
                <h5>Key Features:</h5>
                <ul>
                    <li>Industry-leading noise cancellation</li>
                    <li>30-hour battery life</li>
                    <li>Touch sensor controls</li>
                    <li>Speak-to-chat technology</li>
                </ul>
            </div> --}}
        </div>
    </div>
</div>


@endsection

@push('scripts')
    <script>
        

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           
            $('.shopping-cart-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                method: 'POST',
                data: formData,
                url: "{{ route('add-to-cart') }}",
                success: function(data) {
                    if(data.status === 'success'){
                        getCartCount()
                        fetchSidebarCartProducts()
                        $('.mini_cart_actions').removeClass('d-none');
                        toastr.success(data.message);
                        //console.log(data.message);
                    }else if (data.status === 'error'){
                        toastr.error(data.message);
                    }
                },
                error: function(data) {

                }
            })
        })

        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-count') }}",
                success: function(data) {
                    $('#cart-count').text(data);
                },
                error: function(data) {

                }
            })
        }

        function fetchSidebarCartProducts() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-products') }}",
                success: function(data) {
                    console.log(data);
                    $('.mini_cart_wrapper').html("");
                    var html = '';
                    for (let item in data) {
                        let product = data[item];
                        html += `
                             <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                           <h6 class="my-0"><a href="{{ url('product-detail') }}/${product.options.slug}">${product.name}</a></h6>
                           <small class="text-body-secondary">Quantity: ${product.qty}</small>
                           <br>
                           <small class="text-body-secondary">Variants Total: $${product.options.variants_total}</small>                          
                           </div>
                          <span class="text-body-secondary">$${product.price}</span>
                        </li>
                        `
                    }

                    $('.mini_cart_wrapper').html(html);

                    getSidebarCartSubtoal();

                },
                error: function(data) {

                }
            })
        }


         // get sidebar cart sub total
         function getSidebarCartSubtoal() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#mini_cart_subtotal').text("$" + data);
                },
                error: function(data) {

                }
            })
        }


            })
        
    </script>
@endpush

     {{-- <input type="hidden" name="product_id" value="{{$product->id}}">
                @foreach ($product->variants as $variant)
                @if ($variant->status != 0)
                <h5>{{$variant->name}}:</h5>
                <div class="btn-group" role="group" aria-label="selection">
                    <input type="radio" class="btn-check"   autocomplete="off">
                    @foreach ($variant->productVariantItems as $variantItem)
                    @if ($variantItem->status != 0)
                    <label class="btn btn-outline-success"  value="{{$variantItem->id}}"> {{$variantItem->name}} (${{$variantItem->price}})</label>
                    @endif
                    @endforeach 
                   
                </div>
                @endif
                @endforeach--}}


                <script>
                    function changeImage(event, src) {
                            document.getElementById('mainImage').src = src;
                            document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
                            event.target.classList.add('active');
                        }
                </script>
            