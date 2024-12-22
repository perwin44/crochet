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
                    <h4>Update Product</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Preview</label>
                            <br>
                            <img src="{{asset($product->image)}}" style="width:200px" alt="">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$product->name}}">
                        </div>

                        
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                      <option value="">Select</option>
                                      @foreach ($categories as $category)
                                        <option {{$category->id == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                       

                                <div class="row" >
                                    <div class="col-md-4">
                                <div class="form-group">
                                    <label>SKU1</label>
                                    <input type="text" class="form-control" name="sku1" value="{{$product->sku1}}">
                                </div>
                            </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label>SKU2</label>
                                    <input type="text" class="form-control" name="sku2" value="{{$product->sku2}}">
                                </div>
                            </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label>SKU3</label>
                                    <input type="text" class="form-control" name="sku3" value="{{$product->sku3}}">
                                </div>
                            </div>
                        </div>
        
                        <div class="row" >
                            <div class="col-md-4">
                        <div class="form-group">
                            <label>SKU4</label>
                            <input type="text" class="form-control" name="sku4" value="{{$product->sku4}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>SKU5</label>
                            <input type="text" class="form-control" name="sku5" value="{{$product->sku5}}">
                        </div>
                    </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>SKU6</label>
                            <input type="text" class="form-control" name="sku6" value="{{$product->sku6}}">
                        </div>
                    </div>
                </div>

                       

                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="{{$product->price}}">
                        </div>

                        <div class="form-group">
                            <label>Offer Price</label>
                            <input type="text" class="form-control" name="offer_price" value="{{$product->offer_price}}">
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Offer Start Date</label>
                                    <input type="text" class="form-control datepicker" name="offer_start_date" value="{{$product->offer_start_date}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Offer End Date</label>
                                    <input type="text" class="form-control datepicker" name="offer_end_date" value="{{$product->offer_end_date}}">
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label>Stock Quantity</label>
                            <input type="number" min="0" class="form-control" name="qty" value="{{$product->qty}}">
                        </div>

                        <div class="form-group">
                            <label>Video Link</label>
                            <input type="text" class="form-control" name="video_link" value="{{$product->video_link}}">
                        </div>



                        <div class="form-group">
                            <label>Long Description</label>
                            <textarea name="long_description" class="form-control summernote">{!! $product->long_description !!}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                              <option {{$product->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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
