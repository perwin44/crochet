<section class="py-3" style="background-image: url('{{ asset('frontend/images/background-pattern.jpg') }}');background-repeat: no-repeat;background-size: cover;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
  
          <div class="banner-blocks">
          
            <div class="banner-ad large bg-info block-1">
  
              <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                  @foreach ($sliders as $slider)
                  <div class="swiper-slide">
                    <div class="row banner-content p-5">
                      <div class="content-wrapper col-md-7">
                        <div class="categories my-3">{{$slider->type}}</div>
                        <h3 class="display-4">{{$slider->title}}</h3>
                        <p>{{$slider->description}}</p>
                        <a href="{{route('products.indexfront')}}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Shop Now</a>
                      </div>
                      <div class="img-wrapper col-md-5"  >
                        <img src="{{$slider->image}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  @endforeach
                  
                  {{-- <div class="swiper-slide">
                    <div class="row banner-content p-5">
                      <div class="content-wrapper col-md-7">
                        <div class="categories mb-3 pb-3">100% natural</div>
                        <h3 class="banner-title">Fresh Smoothie & Summer Juice</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
                        <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop Collection</a>
                      </div>
                      <div class="img-wrapper col-md-5">
                        <img src="images/product-thumb-1.png" class="img-fluid">
                      </div>
                    </div>
                  </div> --}}
                  
                  {{-- <div class="swiper-slide">
                    <div class="row banner-content p-5">
                      <div class="content-wrapper col-md-7">
                        <div class="categories mb-3 pb-3">100% natural</div>
                        <h3 class="banner-title">Heinz Tomato Ketchup</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
                        <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop Collection</a>
                      </div>
                      <div class="img-wrapper col-md-5">
                        <img src="images/product-thumb-2.png" class="img-fluid">
                      </div>
                    </div>
                  </div> --}}
                </div>
                
                <div class="swiper-pagination"></div>
  
              </div>
            </div>
            @foreach ($cards as $card)
            @if ($card->status != 0)
            <div class="banner-ad bg-success-subtle block-2" style="background:url('{{$card->image}}') no-repeat;background-size: cover">
              <div class="row banner-content p-5">
  
                <div class="content-wrapper col-md-7" >
                  <div class="categories sale mb-3 pb-3">{{$card->type}}</div>
                  <h3 class="banner-title">{{$card->title}}</h3>
                  <a href="{{$card->btn_url}}" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
                </div>
  
              </div>
            </div>
            @endif
            @endforeach
  
            @foreach ($banners as $banner)
            @if ($banner->status != 0)
            <div class="banner-ad bg-danger block-3" style="background:url('{{$banner->image}}') no-repeat;background-size: cover">
              <div class="row banner-content p-5">
  
                <div class="content-wrapper col-md-7">
                  <div class="categories sale mb-3 pb-3">{{$banner->type}}</div>
                  <h3 class="item-title">{{$banner->title}}</h3>
                  <a href="{{$banner->btn_url}}" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
                </div>
  
              </div>
            </div>
            @endif
            @endforeach
  
          </div>
          <!-- / Banner Blocks -->
            
        </div>
      </div>
    </div>
  </section>