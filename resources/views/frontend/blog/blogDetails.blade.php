@extends('frontend.master')

@section('content')
	<div class="row">
		<div class="blog-page">
			<div class="col-md-12">
				<div class="blog-post wow fadeInUp d-flex justify-content-center">
					<div style="display: table;margin: 0 auto">
						@if(file_exists(@$blog->firstInnerImage) && $blog->firstInnerImage)
							<img class="img-responsive" src="{{ asset($blog->firstInnerImage) }}" alt="">
						@else
							<img class="img-responsive" src="{{$noImage}}" alt="" style="height: 700px">
						@endif
					</div>
					<div style="text-align: center;">
						<h1>{{$blog->firstInnerTitle}}</h1>
						<span class="author">Admin</span>
						
						<div>
							@php
								echo $blog->innerDescription;
							@endphp
						</div>
						<div class="social-media">
							<span>share post:</span>
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}">
								<i class="fa fa-facebook"></i>
							</a>

							 <a target="_blank" href="https://twitter.com/intent/tweet?text={{URL::current()}}">
								<i class="fa fa-twitter"></i>
							</a>

							<a target="_blank" href="http://www.linkedin.com/shareArticle?url={{URL::current()}}">
								<i class="fa fa-linkedin"></i>
							</a>

							<a target="_blank" href="https://api.whatsapp.com/send?text={{URL::current()}}">
		                        <i class="fa fa-whatsapp"></i>
		                     </a>

							<a target="_blank" href="http://pinterest.com/pin/create/button?media={{URL::current()}}" class="hidden-xs">
								<i class="fa fa-pinterest"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

