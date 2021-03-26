@extends('frontend.master') 

@section('content')
<div class='row single-product'>
	<div class="col-md-12">
		@if(Session::get('msg'))
	        <div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	            <strong style="font-weight: bold;color: #0daf3f;font-size: 16px;">
	                Success!
	            </strong> 
	            <strong style="font-weight: bold;color: #097d6a;">
	                @php
	                    echo Session::get('msg');
	                @endphp
	            </strong>
	        </div>
    	@endif

	    @if( count($errors) > 0 )
	        <div class="alert alert-danger alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	            <strong style="font-weight: bold;color: #e4280a;font-size: 16px;">
	                Oops!
	            </strong> 
	            <strong style="font-weight: bold;color: #ca0c0c;;">
	                {{ $errors->first() }}
	            </strong>
	        </div>
	    @endif
	</div>
</div>
	<div class='row single-product'>
		@include('frontend.product.element.sidebar')
		@include('frontend.product.element.productInfo')
	</div>

@endsection
