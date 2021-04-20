@extends('frontend.master')

@section('content')
@php
use App\Product;
use App\Category;
  $categoryId = $category->id;
@endphp
<div class="row category-page-row">
  @include('frontend.category.element.shop_sidebar')
  <div class="col large-9">
    <div class="shop-container">
      <div class="woocommerce-notices-wrapper"></div>
      @if(count($getProductList) > 0)
        <div class="products row row-small large-columns-4 medium-columns-3 small-columns-3 has-shadow row-box-shadow-2 row-box-shadow-5-hover has-equal-box-heights equalize-box">
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
            <div class="product-small col has-hover product type-product post-595 status-publish first instock product_cat-nuts-fruits product_tag-bangladesh product_tag-best product_tag-dates product_tag-medina product_tag-milky product_tag-organic product_tag-pure product_tag-saudi-arabia has-post-thumbnail shipping-taxable purchasable product-type-variable">
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
                                    {{\Illuminate\Support\Str::limit($product->name,35)}}
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
      @else
      <div class="row">
        <div class="large-9">
          <div class="text-center" style="margin: auto;">
            <h3>No Product Available</h3>
        </div>  
        </div>
      </div>
        
      @endif
      <!-- row -->
      <div class="container">
        <nav class="woocommerce-pagination">
          @include('frontend.components.pagination', ['paginator' => $getProductList])
        </nav>
      </div>
    </div><!-- shop container -->   
  </div>
</div>
@endsection