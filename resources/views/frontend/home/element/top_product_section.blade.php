@php
  foreach ($topProductSectionList as $topProductSection) {
    $getProductList = \App\Helper\GetData::GetProductListBySection($topProductSection->id);
    $getCategoryBySection = \App\Helper\GetData::GetCategoryBySection($topProductSection->id);
    if(count(@$getProductList) > 0){
@endphp
  <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">

    <div class="more-info-tab clearfix ">
      <h3 class="new-product-title pull-left">{{$topProductSection->name}}</h3>
      <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
        @if(count(@$getCategoryBySection) > 0 )
          <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
          @php
            foreach ($getCategoryBySection as $category) {
              $categoryTabLink = $category->categoryName."_".$topProductSection->id."_".$category->id;
          @endphp
            <li>
              <a data-transition-type="backSlide" href="#{{$categoryTabLink}}" data-toggle="tab">{{$category->categoryName}}
              </a>
            </li>
          @php } @endphp
         @endif 
      </ul> 
    </div>

    <div class="tab-content outer-top-xs">

      {{-- all product show --}}
      <div class="tab-pane in active" id="all">
        <div class="product-slider">
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
            @foreach ($getProductList as $product)
            @php
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

              if($product->discount){
                $price = $product->discount;
              }else{
                $price = $product->price;
              }
            @endphp
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
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
                    <div class="product-info text-center">
                      <h3 class="name">
                        <a href="{{$getProductDetailsLink}}" title="{{$product->name}}">
                          {{str_limit($product->name,35)}}
                        </a>
                      </h3>
                      <div class="rating">
                          @php echo $getProductReview @endphp
                      </div>
                      <div class="description"></div>
                      @if($product->discount)
                        <div class="product-price"> 
                          <span class="price"> ৳ {{$product->discount}} </span> 
                          <span class="price-before-discount">৳ {{$product->price}}</span> 
                        </div>
                      @else
                        <div class="product-price"> 
                          <span class="price">৳ {{$product->price}}</span> 
                        </div>
                      @endif
                    </div>

                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart" {{$disabled}} onclick="addCart('{{ $product->id}}','{{$price}}')"> 
                              <i class="fa fa-shopping-cart"></i> 
                            </button>
                            <button class="btn btn-primary cart-btn" type="button">
                                Add to cart
                            </button>
                          </li>
                          <li class="lnk wishlist"> 
                            <a data-toggle="tooltip" class="add-to-cart" href= "" title="Wishlist">
                             <i class="icon fa fa-heart"></i> 
                            </a> 
                          </li>
                          <li class="lnk"> 
                            <a data-toggle="tooltip" class="add-to-cart" href= "" title="Compare">
                             <i class="fa fa-signal" aria-hidden="true"></i>
                             </a> 
                           </li>
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                  </div>
                  <!-- /.product --> 

                </div>
                <!-- /.products --> 
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- category wise product --}}
      @php
        foreach ($getCategoryBySection as $category) {
          $categoryTabLink = $category->categoryName."_".$topProductSection->id."_".$category->id;
          $getSectionProductByCategory = \App\Helper\GetData::GetSectionProductByCategory($topProductSection->id,$category->id);
      @endphp
        <div class="tab-pane" id="{{$categoryTabLink}}">
          <div class="product-slider">
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
              @php
                foreach ($getSectionProductByCategory as $product) {
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

                  if($product->discount){
                    $price = $product->discount;
                  }else{
                    $price = $product->price;
                  }
              @endphp
                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
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
                      <div class="product-info text-center">
                        <h3 class="name">
                          <a href="{{$getProductDetailsLink}}" title="{{$product->name}}">
                            {{str_limit($product->name,35)}}
                          </a>
                        </h3>
                        <div class="rating">
                          @php echo $getProductReview @endphp
                        </div>
                        <div class="description"></div>
                        @if($product->discount)
                          <div class="product-price"> 
                            <span class="price"> ৳ {{$product->discount}} </span> 
                            <span class="price-before-discount">৳ {{$product->price}}</span> 
                          </div>
                        @else
                          <div class="product-price"> 
                            <span class="price">৳ {{$product->price}}</span> 
                          </div>
                        @endif
                      </div>
                      <div class="cart clearfix animate-effect">
                        <div class="action">
                          <ul class="list-unstyled">
                            <li class="add-cart-button btn-group">
                              <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart" {{$disabled}} onclick="addCart('{{ $product->id}}','{{$price}}')"> 
                                <i class="fa fa-shopping-cart"></i> 
                              </button>
                              <button class="btn btn-primary cart-btn" type="button">
                                Add to cart
                              </button>
                            </li>
                            <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href= "" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                            <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href= "" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                          </ul>
                        </div>
                        <!-- /.action --> 
                      </div>
                      <!-- /.cart --> 
                    </div> 

                  </div>
                  <!-- /.products --> 
                </div>
              @php } @endphp
            </div>
          </div>
        </div>
      @php } @endphp
    </div>
  </div> 
@php } } @endphp