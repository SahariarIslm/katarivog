@extends('frontend.master')

@section('content')
@php
use App\Product;
use App\Category;

  $categoryId = $category->id;
  $minPrice = Product::where('category_id',$categoryId)->orWhere('root_category',$categoryId)->min('price');
  $maxPrice = Product::where('category_id',$categoryId)->orWhere('root_category',$categoryId)->max('price');
@endphp
  <input type="hidden" class="categoryId" value="{{@$category->id}}">
  <input type="hidden" id="lowerPrice" value="{{$minPrice}}">
  <input type="hidden" id="higherPrice" value="{{$maxPrice}}">
  <input type="hidden" id="sortingBy" value="orderBy">
  <input type="hidden" id="sortingOrder" value="desc">
  <input type="hidden" id="productLimit" value="40">
  <div class='row'>
    <div class='col-md-3 sidebar'> 
      @include('frontend.common.sidebar_category')
      <div class="sidebar-module-container">
        <div class="sidebar-filter"> 
          {{-- <div class="sidebar-widget wow fadeInUp">
            <h3 class="section-title">shop by</h3>
            <div class="widget-header">
              <h4 class="widget-title">Category</h4>
            </div>

            <div class="sidebar-widget-body">
              <div class="accordion">
                <div class="accordion-group">
                  <div class="accordion-heading"> 
                    <a href="#collapseOne" data-toggle="collapse" class="accordion-toggle collapsed"> 
                      Camera 
                    </a> 
                  </div>
                  <div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
                    <div class="accordion-inner">
                      <ul>
                        <li><a href="#">gaming</a></li>
                        <li><a href="#">office</a></li>
                        <li><a href="#">kids</a></li>
                        <li><a href="#">for women</a></li>
                      </ul>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          @if(@$minPrice && @$maxPrice)
            <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
              </div>
              <div class="sidebar-widget-body m-t-10">
                <div class="price-range-holder"> 
                  <span class="min-max"> 
                    <span class="pull-left">৳ <span id="minPrice">{{$minPrice}}</span></span> 
                    <span class="pull-right">৳ <span id="maxPrice">{{$maxPrice}}</span></span> 
                  </span>
                  <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                  <input type="text" class="price-slider" id="priceRange" value="{{$minPrice}},{{$minPrice}}" >
                </div>
                <a href="javascript:void(0)" class="lnk btn btn-primary" onclick="PriceRange()">Show Now</a> 
              </div> 
            </div>
          @endif

        </div>
      </div>
    </div>
    <div class='col-md-9'>
      @if(file_exists($category->headerImage))
      <div id="category" class="category-carousel text-xs">
        <div class="item" id="categoryHeader">
          <div class="image">
            <img src="{{ asset($category->headerImage) }}" alt="" class="img-responsive"> 
          </div>
        </div>
      </div>
      @endif

      <div class="clearfix filters-container m-t-10">
        <div class="row">
          <div class="col col-sm-6 col-md-2">
            <div class="filter-tabs">
              <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                <li class="active"> <a data-toggle="tab" href="#grid-container">
                  <i class="icon fa fa-th-large"></i>
                    Grid
                  </a> 
                </li>
                <li>
                  <a data-toggle="tab" href="#list-container">
                  <i class="icon fa fa-th-list"></i>
                    List
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col col-sm-12 col-md-6">
            <div class="col col-sm-3 col-md-7 no-padding">
              <div class="lbl-cnt"> 
                <span class="lbl">Sort by</span>
                <select style="width: 150px" id="sortBy">
                  <option value="orderBy,asc">Position</option>
                  <option value="name,asc">Product Name: A to Z</option>
                  <option value="price,desc">Price: Hight to Low</option>
                  <option value="price,asc">Price: Low to High</option>
                  <option value="discount,desc">Discount: High to Low</option>
                  <option value="discount,asc">Discount: Low to High</option>
                </select>
              </div>
            </div>

            <div class="col col-sm-3 col-md-5 no-padding">
              <div class="lbl-cnt"> <span class="lbl">Show</span>
                <select style="width: 50px" id="selectProductLimit">
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option selected value="40">40</option>
                  <option value="60">60</option>
                  <option value="80">80</option>
                  <option value="100">100</option>
                  <option value="0">All</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col col-sm-6 col-md-4 text-right">
            <div class="pagination-container categoryProductPaginate">

            </div>
          </div> 
        </div> 
      </div>
      <div class="search-result-container ">
        <div id="myTabContent" class="tab-content category-list">
          <div class="tab-pane active " id="grid-container">
            <div class="category-product">
              <div class="row" id="gridProduct">

              </div>
            </div>
          </div>

          <div class="tab-pane" id="list-container">
            <div class="category-product" id="listProduct">

            </div>
          </div>
        </div>

        <!-- /.tab-content -->
        <div class="clearfix filters-container">
          <div class="text-right">
            <div class="pagination-container categoryProductPaginate">
              
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
@endsection

@section('custom_js')
  <script type="text/javascript">
    jQuery(function () {

  // Price Slider
      if (jQuery('.price-slider').length > 0) {
          jQuery('.price-slider').slider({
              min: {{$minPrice}},
              max: {{$maxPrice}},
              step: 10,
              value: [{{$minPrice}}, {{$maxPrice}}],
              handle: "square",

          });

          /*$( ".slider-handle" ).keyup(function() {
            alert( "Handler for .change() called." );
          });*/
      }
  });
  </script>
@endsection