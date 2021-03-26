@extends('frontend.master')

@section('content')
  <div class='row'>
    <div class='col-md-12'>
      @if(count($productList) > 0)
        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div id="grid-container">
              <div class="category-product">
                <div class="row">
                  @foreach ($productList as $product)
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
                    <div class="col-sm-6 col-md-3 col-xs-6 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="products">
                          <div class="product">
                            <div class="product-image">
                              <div class="image"> 
                                <a href="{{$getProductDetailsLink}}">
                                  @if(file_exists(@$getImage->images))
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
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @else
      <div>
        <h2 style="text-align: center;">There is no product for your request</h2>
      </div>
        
      @endif
    </div> 
  </div>
@endsection