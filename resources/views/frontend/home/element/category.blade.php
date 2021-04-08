<div class="container section-title-container" style="margin-top:20px;margin-bottom:0px;">
    <h3 class="section-title section-title-center">
        <b></b>
        <span class="section-title-main" style="font-size:115%;color:rgb(0, 0, 0);"> Product Groups </span>
        <b></b>
        <a href="{{route('shop')}}">
            Buy Now
            <i class="fa fa-angle-right" style="font-size: 16px;" aria-hidden="true"></i>
        </a>
    </h3>
</div>
<div class="row large-columns-7 medium-columns-3 small-columns-2 row-small has-shadow row-box-shadow-5 slider row-slider slider-nav-circle"  data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": true, "rightToLeft": false, "autoPlay" : false}'>
    @foreach($category_list as $category)
        <div class="product-category col" data-animate="bounceInUp">
            <div class="col-inner">
                <a href="{{ route('category.product',['id'=>$category->id,'name'=>str_replace(' ', '-', $category->categoryName)]) }}">                
                    <div class="box box-category has-hover box-none ">
                        <div class="box-image" >
                            <div class="" >
                                @if (!file_exists(@$category->image))
                                    <img src="{{ $noImage }}" width="200" height="200">
                                @else
                                    <img src="{{ asset('/').$category->image }}" width="300" height="300">
                                @endif                                                      
                            </div>
                            <div>
                                <h3 class="text-center">{{$category->categoryName}}</h3> 
                            </div>
                        </div>
                    </div>
                </a>        
            </div>
        </div>
    @endforeach
</div>