@extends('admin.layouts.master')

@section('section')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header" style="padding-left: 10px;">
            <h1>Product</h1>

          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Product</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>

                        
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                      <option value="">Select</option>
                                      @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                         

                      
                        <div class="row" >
                            <div class="col-md-4">
                        <div class="form-group">
                            <label>SKU1</label>
                            <input type="text" class="form-control" name="sku1" value="{{old('sku1')}}">
                        </div>
                    </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>SKU2</label>
                            <input type="text" class="form-control" name="sku2" value="{{old('sku2')}}">
                        </div>
                    </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>SKU3</label>
                            <input type="text" class="form-control" name="sku3" value="{{old('sku3')}}">
                        </div>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-4">
                <div class="form-group">
                    <label>SKU4</label>
                    <input type="text" class="form-control" name="sku4" value="{{old('sku4')}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>SKU5</label>
                    <input type="text" class="form-control" name="sku5" value="{{old('sku5')}}">
                </div>
            </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label>SKU6</label>
                    <input type="text" class="form-control" name="sku6" value="{{old('sku6')}}">
                </div>
            </div>
        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="{{old('price')}}">
                        </div>

                        <div class="form-group">
                            <label>Offer Price</label>
                            <input type="text" class="form-control" name="offer_price" value="{{old('offer_price')}}">
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Offer Start Date</label>
                                    <input type="text" class="form-control datepicker" name="offer_start_date" value="{{old('offer_start_date')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Offer End Date</label>
                                    <input type="text" class="form-control datepicker" name="offer_end_date" value="{{old('offer_end_date')}}">
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label>Stock Quantity</label>
                            <input type="number" min="0" class="form-control" name="qty" value="{{old('qty')}}">
                        </div>

                        <div class="form-group">
                            <label>Video Link</label>
                            <input type="text" class="form-control" name="video_link" value="{{old('video_link')}}">
                        </div>
                        

                        <div class="form-group">
                            <label>Long Description</label>
                            <textarea name="long_description" class="form-control summernote"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection

@push('scripts')
<script type="text/javascript">

  $(document).ready(function() {

    $('.summernote').summernote();

  });

</script>
@endpush
{{-- 
<div class="container">
     <div class="bg-white rounded d-flex align-items-center justify-content-between" id="header"> <button class="btn btn-hide text-uppercase" type="button" data-toggle="collapse" data-target="#filterbar" aria-expanded="false" aria-controls="filterbar" id="filter-btn" onclick="changeBtnTxt()"> <span class="fas fa-angle-left" id="filter-angle"></span> <span id="btn-txt">Hide filters</span> </button> <nav class="navbar navbar-expand-lg navbar-light pl-lg-0 pl-auto"> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynav" aria-controls="mynav" aria-expanded="false" aria-label="Toggle navigation" onclick="chnageIcon()" id="icon"> <span class="navbar-toggler-icon"></span> </button> <div class="collapse navbar-collapse" id="mynav"> <ul class="navbar-nav d-lg-flex align-items-lg-center"> <li class="nav-item active"> <select name="sort" id="sort"> <option value="" hidden selected>Sort by</option> <option value="price">Price</option> <option value="popularity">Popularity</option> <option value="rating">Rating</option> </select> </li> <li class="nav-item d-inline-flex align-items-center justify-content-between mb-lg-0 mb-3"> <div class="d-inline-flex align-items-center mx-lg-2" id="select2"> <div class="pl-2">Products:</div> <select name="pro" id="pro"> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> </select> </div> <div class="font-weight-bold mx-2 result">18 from 200</div> </li> <li class="nav-item d-lg-none d-inline-flex"> </li> </ul> </div> </nav> <div class="ml-auto mt-3 mr-2"> <nav aria-label="Page navigation example"> <ul class="pagination"> <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true" class="font-weight-bold">&lt;</span> <span class="sr-only">Previous</span> </a> </li> <li class="page-item active"><a class="page-link" href="#">1</a></li> <li class="page-item"><a class="page-link" href="#">..</a></li> <li class="page-item"><a class="page-link" href="#">24</a></li> <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true" class="font-weight-bold">&gt;</span> <span class="sr-only">Next</span> </a> </li> </ul> </nav> </div> </div> 
     <div id="content" class="my-5"> <div id="filterbar" class="collapse"> <div class="box border-bottom"> <div class="form-group text-center"> <div class="btn-group" data-toggle="buttons"> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="radio"> Reset </label> <label class="btn btn-success form-check-label active"> <input class="form-check-input" type="radio" checked> Apply </label> </div> </div> <div> <label class="tick">New <input type="checkbox" checked="checked"> <span class="check"></span> </label> </div> <div> <label class="tick">Sale <input type="checkbox"> <span class="check"></span> </label> </div> </div> <div class="box border-bottom"> <div class="box-label text-uppercase d-flex align-items-center">Outerwear <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box" aria-expanded="false" aria-controls="inner-box" id="out" onclick="outerFilter()"> <span class="fas fa-plus"></span> </button> </div> <div id="inner-box" class="collapse mt-2 mr-1"> <div class="my-1"> <label class="tick">Windbreaker <input type="checkbox" checked="checked"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Jumpsuit <input type="checkbox"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Jacket <input type="checkbox"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Coat <input type="checkbox"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Raincoat <input type="checkbox"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Handbag <input type="checkbox" checked> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Warm vest <input type="checkbox"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Wallets <input type="checkbox" checked> <span class="check"></span> </label> </div> </div> </div> <div class="box border-bottom"> <div class="box-label text-uppercase d-flex align-items-center">season <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box2" aria-expanded="false" aria-controls="inner-box2"><span class="fas fa-plus"></span></button> </div>
      <div id="inner-box2" class="collapse mt-2 mr-1"> <div class="my-1"> <label class="tick">Spring <input type="checkbox" checked="checked"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Summer <input type="checkbox"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Autumn <input type="checkbox" checked> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Winter <input type="checkbox"> <span class="check"></span> </label> </div> <div class="my-1"> <label class="tick">Rainy <input type="checkbox"> <span class="check"></span> </label> </div> </div> </div> <div class="box border-bottom"> <div class="box-label text-uppercase d-flex align-items-center">price <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#price" aria-expanded="false" aria-controls="price"><span class="fas fa-plus"></span></button> </div> <div class="collapse" id="price"> <div class="middle"> <div class="multi-range-slider"> <input type="range" id="input-left" min="0" max="100" value="10"> <input type="range" id="input-right" min="0" max="100" value="50"> <div class="slider">
         <div class="track"></div> <div class="range"></div> <div class="thumb left"></div> <div class="thumb right"></div> </div> </div> </div> <div class="d-flex align-items-center justify-content-between mt-2"> <div> <span id="amount-left" class="font-weight-bold"></span> uah </div> <div> <span id="amount-right" class="font-weight-bold"></span> uah </div> </div> </div> </div> <div class="box"> <div class="box-label text-uppercase d-flex align-items-center">size <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#size" aria-expanded="false" aria-controls="size"><span class="fas fa-plus"></span></button> </div> <div id="size" class="collapse"> <div class="btn-group d-flex align-items-center flex-wrap" data-toggle="buttons"> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox"> 80 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 92 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 102 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 104 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 106 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 108 </label> </div> </div> </div> </div>
          <div id="products"> <div class="row mx-0"> <div class="col-lg-4 col-md-6"> <div class="card d-flex flex-column align-items-center"> <div class="product-name">Torn Jeans for Men</div> <div class="card-img"> <img src="https://www.freepnglogos.com/uploads/jeans-png/jeans-mens-pants-cliparts-download-clip-art-37.png" alt=""> </div> <div class="card-body pt-5"> <div class="text-muted text-center mt-auto">Available Colors</div> <div class="d-flex align-items-center justify-content-center colors my-2"> <div class="btn-group" data-toggle="buttons" data-tooltip="tooltip" data-placement="right" title="choose color"> <label class="btn btn-red form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-blue form-check-label active"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-green form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-orange form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-pink form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> </div> </div> <div class="d-flex align-items-center price"> <div class="del mr-2"><span class="text-dark">5500 uah</span></div> <div class="font-weight-bold">4500 uah</div> </div> </div> </div> </div> <div class="col-lg-4 col-md-6 pt-md-0 pt-3"> <div class="card d-flex flex-column align-items-center"> <div class="product-name">Nike Tshirts for Men</div> <div class="card-img"> <img src="https://www.freepnglogos.com/uploads/t-shirt-png/t-shirt-png-printed-shirts-south-africa-20.png" alt="" height="100" id="shirt"> </div> <div class="text-muted text-center mt-auto">Available Sizes</div> <div id="avail-size"> <div class="btn-group d-flex align-items-center flex-wrap" data-toggle="buttons"> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox"> 80 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 92 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 102 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 104 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 106 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 108 </label> </div> </div> <div class="card-body pt-0"> <div class="text-muted text-center mt-auto">Available Colors</div> <div class="d-flex align-items-center justify-content-center colors my-2"> <div class="btn-group" data-toggle="buttons" data-tooltip="tooltip" data-placement="right" title="choose color"> <label class="btn btn-light border form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-blue form-check-label active"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-green form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-orange form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-pink form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> </div> </div> <div class="d-flex align-items-center price"> <div class="del mr-2"><span class="text-dark">5500 uah</span></div> <div class="font-weight-bold">4500 uah</div> </div> </div> </div> </div> <div class="col-lg-4 col-md-6 pt-lg-0 pt-md-4 pt-3"> <div class="card d-flex flex-column align-items-center"> <div class="product-name text-center">Casual Dress Belts For Men</div> <div class="card-img"> <img src="https://www.freepnglogos.com/uploads/belts-png/casual-dress-belts-for-men-28.png" alt=""> </div> <div class="card-body pt-5"> <div class="text-muted text-center mt-auto">Available Colors</div> <div class="d-flex align-items-center justify-content-center colors my-2"> <div class="btn-group" data-toggle="buttons" data-tooltip="tooltip" data-placement="right" title="choose color"> <label class="btn btn-dark border form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-brown form-check-label active"> <input class="form-check-input" type="radio" autocomplete="off"> </label> </div> </div> <div class="d-flex align-items-center justify-content-center price"> <div class="font-weight-bold">500 uah</div> </div> </div> </div> </div> <div class="col-lg-4 col-md-6 pt-md-4 pt-3"> <div class="card d-flex flex-column align-items-center"> <div class="product-name text-center">Footwear For Women</div> <div class="card-img"> <img src="https://www.freepnglogos.com/uploads/women-shoes-png/download-women-shoes-png-image-png-image-pngimg-2.png" alt=""> </div> <div class="card-body pt-5"> <div class="text-muted text-center mt-auto">Available Colors</div> <div class="d-flex align-items-center justify-content-center colors my-2"> <div class="btn-group" data-toggle="buttons" data-tooltip="tooltip" data-placement="right" title="choose color"> <label class="btn btn-dark border form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-brown form-check-label active"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-pink form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-red form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> </div> </div> <div class="d-flex align-items-center justify-content-center price"> <div class="font-weight-bold">1500 uah</div> </div> </div> </div> </div> <div class="col-lg-4 col-md-6 pt-md-4 pt-3"> <div class="card d-flex flex-column align-items-center"> <div class="product-name text-center">Nike Jogging shoes For Men</div> <div class="card-img"> <img src="https://www.freepnglogos.com/uploads/shoes-png/find-your-perfect-running-shoes-26.png" alt=""> </div> <div class="card-body pt-5"> <div class="text-muted text-center mt-auto">Available Colors</div> <div class="d-flex align-items-center justify-content-center colors my-2"> <div class="btn-group" data-toggle="buttons" data-tooltip="tooltip" data-placement="right" title="choose color"> <label class="btn btn-dark border form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-pink form-check-label active"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-blue form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-orange form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> </div> </div> <div class="d-flex align-items-center justify-content-center price"> <div class="font-weight-bold">1200 uah</div> </div> </div> </div> </div> <div class="col-lg-4 col-md-6 pt-md-4 pt-3"> <div class="card d-flex flex-column align-items-center"> <div class="product-name text-center">Leather Wallets For Men</div> <div class="card-img"> <img src="https://www.freepnglogos.com/uploads/money-png/money-wallet-dollar-image-money-pictures-download-27.png" alt=""> </div> <div class="card-body pt-5"> <div class="text-muted text-center mt-auto">Available Colors</div> <div class="d-flex align-items-center justify-content-center colors my-2"> <div class="btn-group" data-toggle="buttons" data-tooltip="tooltip" data-placement="right" title="choose color"> <label class="btn btn-dark border form-check-label"> <input class="form-check-input" type="radio" autocomplete="off"> </label> <label class="btn btn-brown form-check-label active"> <input class="form-check-input" type="radio" autocomplete="off"> </label> </div> </div> <div class="d-flex align-items-center justify-content-center price"> <div class="font-weight-bold">900 uah</div> </div> </div> </div> </div> </div> </div> </div> </div> --}}