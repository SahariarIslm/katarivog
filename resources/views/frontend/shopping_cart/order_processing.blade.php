@extends('frontend.master')

@section('content')
@php
  use App\ProductAdvance;
  use App\ShippingCharges;
@endphp
  <style type="text/css">
    table td{
      padding-left: 0px !important;
      padding-top: 0px !important;
      padding-bottom: 10px !important;
      padding-right: 5px !important;
    }
  </style>

  <form action="{{route('order.save')}}" method="post">
     {{ csrf_field() }}
    <div class="checkout-box ">
      <div class="row">
        <div class="col-md-6">
          <div class="card-body">
            <h4>SHIPPING ADDRESS</h4>

            <div class="form-group">
              <label for="name">Full Name <span class="required">*</span></label>
              <input class="form-control ng-untouched ng-pristine ng-valid" type="text" name="name" required="1">
            </div>

            <div class="form-group">
              <label for="phone">Phone Number <span class="required">*</span></label>
              <input class="form-control ng-untouched ng-pristine ng-valid" type="text" name="phone" required="1">
            </div>
            
            <div class="form-group">
              <label for="email">Email Address</label>
              <input class="form-control ng-untouched ng-pristine ng-valid" type="email" name="email">
            </div>

            <div class="form-group">
              <label for="shipping_address">Address <span class="required">*</span></label>
              <input class="form-control ng-untouched ng-pristine ng-valid" type="text" name="shipping_address" required="1">
            </div>

            <div class="form-group">
              <button type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue ">
                Submit
              </button>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel-group checkout-steps" id="accordion">
            <div class="panel panel-default checkout-step-01">
              <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                  <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                    <span>1</span>Payment Method
                  </a>
                </h4>
              </div>
              <div {{-- id="collapseOne" class="panel-collapse collapse in" --}}>
                <div class="panel-body">
                  <div class="row">         
                    <div class="col-md-12 col-sm-12 guest-login">
                      <p class="text title-tag-line">Select Your Payment Method</p>
                        <div class="radio radio-checkout-unicase" style="margin-left: 20px;">  
                          <input id="cash_on_delivery" type="radio" name="payment_method" value="cod" checked required="">  
                          <label class="radio-button guest-check" for="cash_on_delivery" style="padding-left: 7px;padding-bottom: 10px">
                            Cash On Delivery
                          </label>  
                          <br>
                          <input id="online_pyment" type="radio" name="payment_method" value="online_pyment">  
                          <label class="radio-button" for="online_pyment" style="padding-left: 7px">
                            Online Payment
                          </label>  
                        </div>  
                    </div>
                  </div>      
                </div>
              </div>
            </div>

            <div class="panel panel-default checkout-step-02">
              <div class="panel-heading">
                <h4 class="unicase-checkout-title">
                  <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseTwo">
                    <span>2</span>Shopping Cart Summary
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body">
                  <div class="row">         
                    <div class="col-md-12 col-sm-12 guest-login">
                      
                      <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-description item">Image</th>
                                    <th class="cart-product-name item" style="text-align: left;">Name</th>
                                    <th class="cart-sub-total item text-center">Code</th>
                                    <th class="cart-qty item text-center">Qty</th>
                                    <th class="cart-total last-item text-center">Amount</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                              @php
                                $total = 0;
                                foreach(Cart::content() as $carts) {
                                  $name = str_replace(' ', '-', $carts->name);
                                  if(file_exists($carts->options->image)){
                                      $image = asset('/'.@$carts->options->image);
                                  }
                                  else{
                                      $image = $noImage;
                                  }
                              @endphp
                                <tr>
                                  <td width="80px">
                                    <a href="{{route('product.details',['id'=>@$carts->id,'name'=>@$name])}}">
                                      <img src="{{ $image }}" style="height: 60px;">
                                    </a>
                                  </td>

                                  <td>
                                    <a href="{{route('product.details',['id'=>@$carts->id,'name'=>@$name])}}" title="{{$carts->name}}">
                                      {{str_limit($carts->name,20)}}
                                    </a>
                                  </td>

                                  <td class="text-center">{{$carts->options->deal_code}}</td>
                                  <td class="text-center">{{$carts->qty}}</td>
                                  <td class="text-center">{{$carts->subtotal}}</td>
                                </tr>
                                @php
                                  $total += $carts->subtotal;
                                  $free_shipping = ProductAdvance::where('free_shipping','free')->where('productId',$carts->id)->first();
                                @endphp
                              @php 
                                }

                                  $total = str_replace(',', '', $total);
                                  $shipping_charges = ShippingCharges::where('shippingStatus',1)->get();
                                  foreach($shipping_charges as $k ){ 
                                      $diff[abs($k->shippingAmount - $total)] = $k;
                                       }

                                  if (@$k && $total) {
                                      ksort($diff, SORT_NUMERIC);
                                      $charge = current($diff);
                                      if ($free_shipping) {
                                          
                                          $shippingCharge = 0;
                                      }else{
                                          $shippingCharge = $charge->shippingCharge;
                                      }
                                      
                                  }else{
                                      $shippingCharge = 0; 
                                  } 

                                  $grandTotal = $total + $shippingCharge;
                              @endphp

                            </tbody>
                        </table>

                        <table style="margin-top: -80px">
                            <tr>
                              <td colspan="3">
                                  <div class="shopping-cart-btn">
                                      <span class="">
                                          <a href="{{ route('cart.index') }}" class="btn btn-upper btn-primary outer-left-xs">Edit Shopping Cart
                                          </a>
                                      </span>
                                  </div>
                              </td>

                              <td width="1000px">
                                <table class="table" style="width: 250px;float: right;margin-top: 70px;">
                                  <thead>
                                      <tr>
                                        <th>Subtotal</th>
                                        <th style="text-align: right;">{{Cart::subtotal()}}</th>
                                      </tr>
                                      <tr>
                                        <th>Shipping Charge</th>
                                        <th style="text-align: right;">৳ {{number_format($shippingCharge, 2, '.', '')}}</th>
                                      </tr>

                                      <tr>
                                        <th>Grand Total</th>
                                        <th style="text-align: right;">৳ {{number_format($grandTotal, 2, '.', '')}}</th>
                                      </tr>
                                  </thead>
                              </table>
                              </td>
                          </tr>
                        </table>
                    </div>
                    </div>
                  </div>      
                </div>
              </div>
            </div>

          </div>  
        </div>
      </div>
    </div>

    <input type="hidden" name="shipping_charge" value="{{$shippingCharge}}">
    <input type="hidden" name="total_amount" value="{{$grandTotal}}">
  </form>
@endsection


