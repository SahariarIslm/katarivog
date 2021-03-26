@php
  use App\ProductAdvance;
    $getProductReview = \App\Helper\GetData::ProductReview($product->id);
    $totalReview = \App\Helper\GetData::TotalReview($product->id);

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

    $productSection = ProductAdvance::where('productId',$product->id)->first();

    if(@$productSection->hotDiscount != ''){
        $price = $productSection->hotDiscount;
    }elseif(@$productSection->specialDiscount != ''){
        $price = $productSection->specialDiscount;
    }
    elseif($product->discount){
        $price = $product->discount;
      }else{
        $price = $product->price;
    }
@endphp
<div class='col-md-9'>
    <div class="detail-block">
        <div class="row wow fadeInUp">
           <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                <div class="product-item-holder size-big single-product-gallery small-gallery">

                    <div id="owl-single-product">
                        @php
                            $i = 0;
                            foreach ($product_images as $image) {
                                $i++;
                        @endphp
                            <div class="single-product-gallery-item" id="slide{{$i}}">
                                <a data-lightbox="image-{{$i}}" data-title="Gallery" href="{{asset('public/frontend')}}">
                                    <img class="img-responsive" alt="" src="{{asset($image->images)}}" data-echo="{{asset($image->images)}}" />
                                </a>
                            </div>
                        @php } @endphp
                    </div>

                    <div class="single-product-gallery-thumbs gallery-thumbs">
                        <div id="owl-single-product-thumbnails">
                            @php
                                $i = 0;
                                foreach ($product_images as $image) {
                                    $i++;
                            @endphp
                                <div class="item">
                                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="{{$i}}" href="#slide{{$i}}">
                                        <img class="img-responsive" width="85" alt="" src="{{asset($image->images)}}" data-echo="{{asset($image->images)}}" />
                                    </a>
                                </div>
                            @php } @endphp
                        </div>
                    </div>
                </div>
            </div>

            <div class='col-sm-6 col-md-7 product-info-block'>
                <div class="product-info">
                    <h1 class="name">{{$product->name}}</h1>
                    <div class="rating-reviews m-t-20">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="rating">
                                    @php echo $getProductReview @endphp
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="reviews">
                                    <a href="#" class="lnk">({{$totalReview}} Reviews)</a>
                                </div>
                            </div>
                        </div>       
                    </div>

                    <div class="stock-container info-container m-t-10">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="stock-box">
                                    <span class="label">Availability :</span>
                                </div>  
                            </div>
                            <div class="col-sm-9">
                                <div class="stock-box">
                                    <span class="value">{{$availability}}</span>
                                </div>  
                            </div>
                        </div> 
                    </div>

                    <div class="description-container m-t-20">
                        @php
                            echo $product->description1;
                        @endphp
                    </div>

                    <div class="price-container info-container m-t-20">
                        <div class="row">
                            <div class="col-sm-6">
                                @if(@$productSection->hotDiscount != '')
                                    <div class="price-box">
                                        <span class="price">৳ {{$productSection->hotDiscount}}</span>
                                        <span class="price-strike">৳ {{$product->price}}</span>
                                    </div>
                                @elseif(@$productSection->specialDiscount != '')
                                    <div class="price-box">
                                        <span class="price">৳ {{$productSection->specialDiscount}}</span>
                                        <span class="price-strike">৳ {{$product->price}}</span>
                                    </div>
                                @elseif($product->discount)
                                    <div class="price-box">
                                        <span class="price">৳ {{$product->discount}}</span>
                                        <span class="price-strike">৳ {{$product->price}}</span>
                                    </div>
                                @else
                                    <div class="price-box">
                                        <span class="price">৳ {{$product->price}}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <div class="favorite-button m-t-10">
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                        <i class="fa fa-signal"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="quantity-container info-container">
                        <div class="row">
                            <div class="col-sm-1">
                                <span class="label">Qty :</span>
                            </div>

                            <div class="col-sm-3">
                                <div class="cart-quantity">
                                    <div class="quant-input">
                                      <input type="number" value="1" min="1" id="productQty" style="width: 100px">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <a href="javascript:void(0)" class="btn btn-primary" {{$disabled}} onclick="addCart('{{ $product->id}}','{{$price}}')">
                                    <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('frontend.product.element.product_review')

    @include('frontend.product.element.relatedProduct')

</div>