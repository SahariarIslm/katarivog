@extends('frontend.master')

@section('content')
	<div class="checkout-box faq-page">
		<div class="row">
		    <div class="col-md-12">
		        <h2 class="heading-title">Frequently Asked Questions</h2>
		        <div class="panel-group checkout-steps" id="accordion">
		        	@php
		        		$i = 0;
		        		foreach ($faqList as $faq) {
		        		$i++;
		        	@endphp
			            <div class="panel panel-default checkout-step-{{$i}}">
			                <div class="panel-heading">
			                    <h4 class="unicase-checkout-title">
			                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapse_{{$i}}"> <span>{{$i}}</span> {{$faq->title}} ? </a>
			                    </h4>
			                </div>
			                <!-- panel-heading -->

			                <div id="collapse_{{$i}}" class="panel-collapse collapse @if($i == 1) in @endif">
			                    <!-- panel-body  -->
			                    <div class="panel-body">
			                        @php
			                        	echo $faq->description;
			                        @endphp
			                    </div>
			                    <!-- panel-body  -->
			                </div>
			                <!-- row -->
			            </div>
			        @php
			        	}
			        @endphp
		        </div>
		    </div>
		</div>
	</div>
@endsection