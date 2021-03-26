@php
  foreach ($topProductSectionList as $topProductSection) {
    $getProductList = \App\Helper\GetData::GetProductListBySection($topProductSection->id);
    $getCategoryBySection = \App\Helper\GetData::GetCategoryBySection($topProductSection->id);
    if(count(@$getProductList) > 0){
@endphp
<div class="container section-title-container" style="margin-top:0px;margin-bottom:0px;">
    <h3 class="section-title section-title-center">
        <b></b>
        <span class="section-title-main" style="font-size:115%;color:rgb(0, 0, 0);">{{$topProductSection->name}}</span>
        <b></b>
        <a href="shop/index.html" target="">Shop Now<i class="icon-angle-right" ></i></a>
    </h3>
</div>
<div class="woocommerce columns-6 ">
    <div class="products row row-small large-columns-6 medium-columns-3 small-columns-3 has-shadow row-box-shadow-2 row-box-shadow-5-hover has-equal-box-heights equalize-box">
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
            <div class="product-small col has-hover product type-product post-694 status-publish first instock product_cat-homemade-pickle product_tag-bangladesh product_tag-best product_tag-deshi product_tag-milky product_tag-organic product_tag-pure product_tag-spice has-post-thumbnail featured shipping-taxable purchasable product-type-variable">
                <div class="col-inner">
                    <div class="badge-container absolute left top z-1"></div>
                    <div class="product-small box ">
                        <div class="box-image">
                            <div class="image-zoom">
                                <a href="{{$getProductDetailsLink}}"> 
                                    @if(file_exists(@$getImage->images))
                                      <img width="300" height="300" src="{{asset($getImage->images)}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" srcset="{{asset($getImage->images)}}" sizes="(max-width: 300px) 100vw, 300px" /> 
                                    @else
                                      <img width="300" height="300" src="{{$noImage}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" srcset="{{$noImage}}" sizes="(max-width: 300px) 100vw, 300px" /> 
                                    @endif           
                                </a>
                            </div>
                            <div class="image-tools is-small top right show-on-hover"></div>
                            <div class="image-tools is-small hide-for-small bottom left show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a href="{{$getProductDetailsLink}}" data-quantity="1" class="add-to-cart-grid no-padding is-transparent product_type_variable add_to_cart_button" data-product_id="694" data-product_sku="THAISAUCE01" aria-label="Select options for &ldquo;Sweet &amp; Sour Chili Sauce&rdquo;" rel="nofollow">
                                    <div class="cart-icon tooltip is-small" title="Select options">
                                        <strong>+</strong>
                                    </div>
                                </a>  
                                <a class="quick-view" data-prod="694" href="#quick-view">Quick View</a>            
                            </div>
                        </div>
                        <div class="box-text box-text-products text-center grid-style-2">
                            <div class="title-wrapper">
                                <p class="name product-title">
                                    <a href="{{$getProductDetailsLink}}">
                                        {{str_limit($product->name,35)}}
                                    </a>
                                </p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">
                                    <span class="woocommerce-Price-amount amount">
                                        <bdi>
                                            <span class="woocommerce-Price-currencySymbol">
                                                ৳ {{$product->price}}
                                            </span>
                                        </bdi>
                                    </span>
                                </span>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@php } } @endphp
        