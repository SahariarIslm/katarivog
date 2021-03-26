@php
  use App\Product;
@endphp
<div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
  
  @include('frontend.common.hot_deals')

  <div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Offer</h3>
    <div class="sidebar-widget-body outer-top-xs">
      <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
        @foreach ($specialProductList as $specialProduct)
        @php
          $product = Product::find($specialProduct->productId);
          $getImage = \App\Helper\GetData::GetProductImage($product->id);
          $getProductDetailsLink = \App\Helper\GetData::ProductDetailsLink($product->id);
          $getProductReview = \App\Helper\GetData::ProductReview($product->id);
        @endphp
          <div class="item">
            <div class="products special-product">

              <div class="product">
                <div class="product-micro">
                  <div class="row product-micro-row">
                    <div class="col col-xs-5">
                      <div class="product-image">
                        <div class="image"> 
                          <a href="{{$getProductDetailsLink}}">
                            @if(file_exists($getImage->images))
                              <img src="{{asset($getImage->images)}}" alt="">
                            @else
                              <img src="{{$noImage}}" alt="">
                            @endif
                          </a> 
                        </div>
                      </div>
                    </div>
                    <div class="col2 col-xs-7">
                      <div class="product-info">
                        <h3 class="name">
                          <a href="{{$getProductDetailsLink}}" title="{{$product->name}}">
                            {{str_limit($product->name,20)}}
                          </a>
                        </h3>
                        <div class="rating">
                          @php echo $getProductReview @endphp
                        </div>
                        @if($specialProduct->specialDiscount)
                        <div class="product-price"> 
                          <span class="price"> ৳ {{$specialProduct->specialDiscount}} </span> 
                          <span class="price-before-discount">৳ {{$product->price}}</span> 
                        </div>
                      @else
                        <div class="product-price"> 
                          <span class="price">৳ {{$product->price}}</span> 
                        </div>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  @include('frontend.common.newsletter')

  @include('frontend.common.testimonial')

</div>