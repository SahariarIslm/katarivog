@extends('frontend.master') 

@section('content')
        <div class="container-width">
            @include('frontend.components.cart_breadcrumb')
            <div class="row">
               <div id="content" class="large-12 col" role="main">
                    <div class="woocommerce" id="main_cart">
                    </div>
               </div>
            </div>
        </div>
@endsection
