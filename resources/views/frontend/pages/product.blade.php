

@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name}} || Products
@endsection

@section('content')


<div class="container mt-5 mb-5">

    <div class="d-flex justify-content-center row">
        <div class="col-md-3">
            <div class="form-group" >
                <div class="card">
                    <article class="card-group-item ">
                        <header class="card-header  ">
                            <h6 class="title ">Range input </h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                            <div class="form-row" style="">
                            <div class="form-group col-md-6">
                              <label>Min</label>
                              <input type="number" class="form-control" id="inputEmail4" placeholder="$0" >
                            </div>
                            <div class="form-group col-md-6 text-right">
                              <label>Max</label>
                              <input type="number" class="form-control" placeholder="$1,0000">
                            </div>
                            </div>
                            </div> <!-- card-body.// -->
                        </div>
                    </article> <!-- card-group-item.// -->
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">All Categories </h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">

                            
                                @foreach ($categories as $category)
                                <div class="custom-control custom-checkbox">  
                                     <span class="float-right badge  round" style="color: brown">{{$category ->products->count() > 0 ? $category->products->count():0}}</span>  
                          

                                     <label class="button" ><a href="{{route('products.indexfront',['category' => $category->slug] )}}">{{$category->name}}</a></label>
                                    
                                </div>
                                @endforeach
                              {{--   <div class="custom-control custom-checkbox">
                                    <span class="float-right badge badge-light round">17</span>
                                      <input type="checkbox" class="custom-control-input" id="Check3">
                                      <label class="custom-control-label" for="Check3">Samsung</label>
                                </div> 
                                ['category' => $category->slug]
                
                                <div class="custom-control custom-checkbox">
                                    <span class="float-right badge badge-light round">7</span>
                                      <input type="checkbox" class="custom-control-input" id="Check4">
                                      <label class="custom-control-label" for="Check4">Other Brand</label>
                                </div>  --}}
                            </div> <!-- card-body.// -->
                        </div>
                    </article> <!-- card-group-item.// -->
                </div> <!-- card.// -->
        </div>
    </div>
    <div class="col-md-9">
            <div class="form-group">
            @foreach($products as $product)
            <div class="row p-2 bg-white border rounded" >
                <div class="col-sm-3 mt-1 " style="border-radius:4px"><img style="aspect-ratio:1/1;object-fit:cover" class="img-fluid img-responsive rounded product-image" src="{{$product->image}}"></div>
                <div class="col-sm-6 mt-1">
                    <h5>{{$product->name}}</h5>
                    @if ($product->qty > 0)
                    <p class="wsus__stock_area"><span class="in_stock">in stock</span> ({{$product->qty}} item)</p>
                    @elseif ($product->qty === 0)
                    <p class="wsus__stock_area"><span class="out_stock">stock out</span> ({{$product->qty}} item)</p>
                    @endif
                    <div href="" class="text-reset">
                        <p>{{$product->category->name}}</p>
                      </div>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                    </div>
                    <div class="mt-1 mb-1 spec-1"><span>{{$product->sku1}}</span><span class="dot"></span><span>{{$product->sku2}}</span><span class="dot"></span><span>{{$product->sku3}}<br></span></div>
                    <div class="mt-1 mb-1 spec-1"><span>{{$product->sku4}}</span><span class="dot"></span><span>{{$product->sku5}}</span><span class="dot"></span><span>{{$product->sku6}}<br></span></div>
                    <p class="text-justify text-truncate para mb-0">{{$product->long_description}}<br><br></p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">${{$product->price}}
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span class="strike-text">${{$product->offer_price}}</span>
                    </div>
                    <h6 class="text-success">Free shipping</h6>
                    <div class="d-flex flex-column mt-4">
                        
                        <a class="btn btn-primary btn-sm" type="button" href="{{route('product-detail', $product->slug)}}">Details</a>
                        
                    <button class="btn btn-outline-primary btn-sm mt-2" type="button">Add to wishlist</button>
                </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
    </div>

@endsection