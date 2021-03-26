@extends('frontend.master')

@section('content')
	<div class="row">
	    <div class="blog-page">
	        <div class="col-md-12">
	        	<div class="row">
	        		@foreach($blogList as $blog)
			        @php
			          $create_date = date('d F Y', strtotime($blog->created_at));
			        @endphp
		        		<div class="col-md-6">
		        			<div class="blog-post wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
				               <a href="{{route('blog.details',$blog->id)}}">
				                    @if(file_exists($blog->firstHomeImage))
				                      <img class="img-responsive"  src="{{asset($blog->firstHomeImage)}}" alt="">
				                    @else
				                      <img src="{{$noImage}}" alt="" style="height: 350px">
				                    @endif
				                </a>
				                <h3 class="name">
				                	<a href="{{route('blog.details',$blog->id)}}">{{$blog->firstHomeTitle}}</a>
				                </h3>
				                 <span class="info">By Author &nbsp;|&nbsp; {{$create_date}} </span>
					                <div style="height: 70px">
					                  @php
					                    echo str_limit($blog->homeDescription,350);
					                  @endphp
					                </div>
				                <a href="{{route('blog.details',$blog->id)}}" class="lnk btn btn-primary">Read more</a>
				            </div>
		        		</div>
	        		@endforeach
	        	</div>

	            <div class="clearfix blog-pagination filters-container wow fadeInUp animated" style="padding: 0px; background: none; box-shadow: none; margin-top: 15px; border: none; visibility: visible; animation-name: fadeInUp;">
	                <div class="text-right">
	                    <div class="pagination-container">
	                        {{$blogList->links()}}
	                    </div>
	                </div>
	            </div>

	        </div>
	        
	    </div>
	</div>

@endsection

