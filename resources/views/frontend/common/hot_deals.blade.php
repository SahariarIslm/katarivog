@php
  use App\Product;
@endphp
@if(count($hotProductList) > 0)
  <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">hot deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
      @foreach ($hotProductList as $hotProduct)
        @php
          $product = Product::find($hotProduct->productId);
          $getImage = \App\Helper\GetData::GetProductImage($product->id);
          $getProductDetailsLink = \App\Helper\GetData::ProductDetailsLink($product->id);
          $getProductReview = \App\Helper\GetData::ProductReview($product->id);

          $stockCheck = \App\Helper\GetData::StockCheck($product->id);
          if($stockCheck->id != NULL && $stockCheck->remainingQty == 0 || $stockCheck->remainingQty < 0){
            $disabled = "disabled";
            $availability = "Out of Stock";
            $availabilityColor = "red";
          }else{
            $disabled = "";
            $availability = "In Stock";
            $availabilityColor = "green";
          }

          $price = $hotProduct->hotDiscount;
        @endphp
        <div class="item">
          <div class="products">
            <div class="hot-deal-wrapper">
              <div class="image"> 
                <a href="{{$getProductDetailsLink}}">
                  @if(file_exists($getImage->images))
                    <img src="{{asset($getImage->images)}}" alt="">
                  @else
                    <img src="{{$noImage}}" alt="">
                  @endif
                </a> 
              </div>
              {{-- <div class="sale-offer-tag"><span>49%<br>
              off</span></div> --}}
              <div class="timing-wrapper">
                <div class="box-wrapper">
                  <div class="date box"> 
                    <span class="key" style="width: 100px">{{$hotProduct->hotDate}}</span> 
                  </div>
                </div>
                {{-- <div class="box-wrapper">
                  <div class="date box"> 
                    <span class="key">120</span> 
                    <span class="value">DAYS</span> 
                  </div>
                </div>
                <div class="box-wrapper">
                  <div class="hour box"> 
                    <span class="key">20</span> 
                    <span class="value">HRS</span> 
                  </div>
                </div>
                <div class="box-wrapper">
                  <div class="minutes box"> 
                    <span class="key">36</span> 
                    <span class="value">MINS</span> 
                  </div>
                </div>
                <div class="box-wrapper hidden-md">
                  <div class="seconds box"> 
                    <span class="key">60</span> 
                    <span class="value">SEC</span> 
                  </div>
                </div> --}}

              </div>
            </div>
            <!-- /.hot-deal-wrapper -->

            <div class="product-info text-center m-t-20">
              <h3 class="name">
                <a href= "{{$getProductDetailsLink}}" title="{{$product->name}}}">
                  {{str_limit($product->name,30)}}
                </a>
                </h3>
              <div class="rating">
                  @php echo $getProductReview @endphp
                </div>
                @if($hotProduct->hotDiscount)
                <div class="product-price"> 
                  <span class="price"> ৳ {{$hotProduct->hotDiscount}} </span> 
                  <span class="price-before-discount">৳ {{$product->price}}</span> 
                </div>
              @else
                <div class="product-price"> 
                  <span class="price">৳ {{$product->price}}</span> 
                </div>
              @endif
            </div>
          </div>
          <div class="cart clearfix animate-effect">
            <div class="action">
              <div class="add-cart-button btn-group" onclick="addCart('{{ $product->id}}','{{$price}}')">
                <button class="btn btn-primary icon" data-toggle="dropdown" type="button" {{$disabled}}> 
                  <i class="fa fa-shopping-cart"></i> 
                </button>
                <button class="btn btn-primary cart-btn" type="button" {{$disabled}}>Add to cart</button>
              </div>
            </div> 
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif