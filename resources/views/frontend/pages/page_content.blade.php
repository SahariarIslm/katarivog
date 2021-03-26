@extends('frontend.master')

@section('content')
	<div class="terms-conditions-page">
	    <div class="row">
	        <div class="col-md-12 terms-conditions">
	            <h2 class="heading-title">{{@$menu->firstHomeTitle}}</h2>
	            <div class="">
	                @php
	                	echo $menu->homeDescription;
	                @endphp
	            </div>
	        </div>
	    </div>
	    <!-- /.row -->
	</div>
	<!-- /.sigin-in-->
@endsection
