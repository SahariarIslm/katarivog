@extends('frontend.master') 
@section('content')
@php
  use App\ProductAdvance;
  use App\Product;
  use App\Category;
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
    $pproduct       = Product::where('id',$product->id)->first();
    $category       = Category::where('id',$pproduct->category_id)->first();
    $getImage = \App\Helper\GetData::GetProductImage($product->id);


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
<main id="main" class="">
	<div class="shop-container">
		<div class="container">
			<div class="woocommerce-notices-wrapper"></div>
		</div>
		<div id="product-625" class="post-625 product type-product status-publish has-post-thumbnail product_cat-herbal product_tag-bangladesh product_tag-best product_tag-deshi product_tag-herbal product_tag-kkalojeera product_tag-milky product_tag-organic product_tag-pure product_tag-spice first instock featured shipping-taxable purchasable product-type-variable">
			<div class="custom-product-page">
				<div id="page-header-178638541" class="page-header-wrapper">
  					<div class="page-title dark featured-title has-parallax box-shadow-2">
        				<div class="page-title-bg">
      						<div class="title-bg fill bg-fill" data-parallax-container=".page-title" data-parallax-background data-parallax="-10"></div>
      						<div class="title-overlay fill"></div>
    					</div>
					    <div class="page-title-inner container align-center text-center flex-row-col medium-flex-wrap" data-parallax-fade="true" data-parallax="-5">
					        <div class="title-wrapper flex-col">
					          	<h1 class="entry-title mb-0">{{$product->name}}</h1>
					        </div>
					        <div class="title-content flex-col">
					        	<div class="title-breadcrumbs pb-half pt-half">
					        		<nav class="woocommerce-breadcrumb breadcrumbs ">
					        			<a href="{{ route('home.index') }}">Home</a> 
					        			<span class="divider">&#47;</span> 
					        			<a href="{{ route('category.product',['id'=>$category->id,'name'=>str_replace(' ', '-', $category->categoryName)]) }}">{{ $category->categoryName }}</a>
					        		</nav>
					        	</div>      
					        </div>
					    </div>
						<style scope="scope">
							#page-header-178638541 .page-title-inner {
							  min-height: 0px;
							}
							#page-header-178638541 {
							  margin-bottom: 20px;
							}
							#page-header-178638541 .title-bg {
							  background-image: url({{ asset('/') }}/public/frontend/assets/wp-content/uploads/2020/07/grass-534873_1920.jpg);
							  background-position: 25% 84%;
							}
							#page-header-178638541 .title-overlay {
							  background-color: rgba(0,0,0,.5);
							}
						</style>
					</div>
				</div>
  				<div class="row row-full-width align-center row-solid row-box-shadow-3 row-box-shadow-3-hover"  id="row-1788521946">
					<div class="col medium-5 small-12 large-5">
						<div class="col-inner">
							<div class="product-images relative mb-half has-hover woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4">
  								<div class="badge-container is-larger absolute left top z-1"></div>
  								<div class="image-tools absolute top show-on-hover right z-3"></div>
								<figure class="woocommerce-product-gallery__wrapper product-gallery-slider slider slider-nav-small mb-half"
							        data-flickity-options='{
							                "cellAlign": "center",
							                "wrapAround": true,
							                "autoPlay": false,
							                "prevNextButtons":true,
							                "adaptiveHeight": true,
							                "imagesLoaded": true,
							                "lazyLoad": 1,
							                "dragThreshold" : 15,
							                "pageDots": false,
							                "rightToLeft": false       }'>
	    							<div data-thumb="{{asset($getImage->images)}}" class="woocommerce-product-gallery__image slide first">
	    								<a href="{{asset($getImage->images)}}" data-fancybox="gallery">
	    									@if(file_exists(@$getImage->images))
	    									<img width="320" height="320" src="{{asset($getImage->images)}}" class="{{asset($getImage->images)}} 1200w" alt=""/>
	    									@else
	    									<img width="320" height="320" src="{{$noImage}}" class="wp-post-image skip-lazy" srcset="{{$noImage}}" alt=""/>
	    									@endif
	    								</a>
	    							</div>  
	    						</figure>
								<div class="image-tools absolute bottom left z-3">
								    <a href="#product-zoom" class="zoom-button button is-outline circle icon tooltip hide-for-small" title="Zoom">
								      	<i class="icon-expand" ></i>    
								  	</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col medium-6 small-12 large-6">
						<div class="col-inner text-left">
							<div class="product-title-container is-larger">
								<h1 class="product-title product_title entry-title">
									{{$product->name}}
								</h1>
							</div>
							<div class="product-price-container is-xxlarge">
								<div class="price-wrapper">
									<p class="price product-page-price ">
								  		<span class="woocommerce-Price-amount amount">
								  			<bdi><span class="woocommerce-Price-currencySymbol">&#2547;&nbsp;</span>{{$product->price}}</bdi>
								  		</span>
								  	</p>
								</div>
							</div>
							<div class="add-to-cart-container form-flat is-normal">
								<div class="row">
									<label class="col-md-3" for="weight">Availabilty:</label> 
									<span class="col-md-3">{{'   '}}{{$availability}}</span>
								</div>		
								<div class="single_variation_wrap">
									<div class="woocommerce-variation single_variation"></div>
									<div class="woocommerce-variation-add-to-cart variations_button">
										<div class="quantity buttons_added form-flat">
											<input type="button" value="-" class="minus button is-form">			
											<label class="screen-reader-text" for="quantity_60518ed75b771">
												Black Seed quantity
											</label>
											<input type="number" id="quantity" class="input-text qty text" step="1 "min="1" max="" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric"/>
											<input type="button" value="+" class="plus button is-form">	
										</div>
										<button type="submit" onclick="addCart('{{ $product->id}}','{{$price}}',this)" class="single_add_to_cart_button button alt">Add to cart</button>
									</div>
								</div>
							</div>
							<div class="product-short-description">
								<p>
									<span style="font-size: 115%; color: #000000;">
										<strong>Short Description:</strong>
									</span>
								</p>
								<P>
									@php
			                            echo $pproduct->description2;
			                        @endphp
								</P>
							</div>
						</div>
					</div>
					<style scope="scope"></style>
				</div>
				{{-- <div class="product-page-sections">
					<div class="product-section">
						<div class="row">
							<div class="large-4 col pb-0 mb-0">
								 <h5 class="uppercase mt">Additional information</h5>
							</div>
							<div class="large-8 col pb-0 mb-0">
								<div class="panel entry-content">
									<table class="woocommerce-product-attributes shop_attributes">
										<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_weight">
											<th class="woocommerce-product-attributes-item__label">Stock</th>
											<td class="woocommerce-product-attributes-item__value"><p>200gm</p></td>
											</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="product-section">
						<div class="row">
							<div class="large-2 col pb-0 mb-0">
								 <h5 class="uppercase mt">Reviews (0)</h5>
							</div>
							<div class="large-10 col pb-0 mb-0">
								<div class="panel entry-content">
									<div id="reviews" class="woocommerce-Reviews row">
										<div id="comments" class="col large-12">
											<h3 class="woocommerce-Reviews-title normal">Reviews</h3>
											<p class="woocommerce-noreviews">There are no reviews yet.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
				
			</div>
		</div>
	</div>
</main>
@endsection
