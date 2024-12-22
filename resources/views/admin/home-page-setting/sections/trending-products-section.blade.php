@php
    $trendingProductsSection = json_decode($trendingProductsSection->value);

@endphp

<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('trending-products-section')}}" method="POST">
                @csrf
                @method('PUT')

                {{-- <h5>All</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{@$trendingProductsSection->value == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                </div> --}}

                <h5>Category 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_one" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{$category->id == $trendingProductsSection[0]->category ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                </div>

                <h5>Category 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_two" id="" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{$category->id == $trendingProductsSection[1]->category ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>


                <h5>Category 3</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_three" id="" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{$category->id == $trendingProductsSection[2]->category ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                    
                </div>

                <h5>Category 4</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_four" id="" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{$category->id == $trendingProductsSection[3]->category ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>



                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
   
@endpush
