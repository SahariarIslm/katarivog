<style type="text/css">
	#owl-main{
		height: 100%;
	}
</style>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<div id="hero">
		<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
			@php
				foreach ($slider_list as $slider) {
					if(file_exists($slider->image)){
						$slider_image = asset($slider->image);
					}else{
						$slider_image = $noImage;
					}
			@endphp
				<div class="item" style="background-image: url({{$slider_image}});">
					<div class="container-fluid">
						<div class="caption bg-color vertical-center text-left">
							<div class="slider-header fadeInDown-1">{{$slider->firstTitle}}</div>
							<div class="big-text fadeInDown-1"> {{$slider->secondTitle}} </div>
							<div class="excerpt fadeInDown-2 hidden-xs"> 
								@php
									echo $slider->description;
								@endphp
							</div>
							@if($slider->link)
								<div class="button-holder fadeInDown-3"> 
									<a href="{{$slider->link}}" class="btn-lg btn btn-uppercase btn-primary shop-now-button">
										<b>Shop Now</b>
									</a> 
								</div>
							@endif
						</div>
					</div>
				</div>
			@php } @endphp
		</div>
	</div>
</div>