@extends('frontend.master') 

@section('content')
@php
	use App\Product;
@endphp
        <div class="container-width">
    		<div class="focused-checkout-header pb pt">
		      <div class="checkout-page-title page-title">
		      	<a class="no-click hide-for-small">
	              <h3 class="text-center">Order Complete</h3>
	            </a>
		      </div>
		  </div>
            
            <div class="row">
               <div id="content" class="large-12 col" role="main">
                    <div class="woocommerce">
                    	<div class="row">
						   <div class="large-7 col">
						      <section class="woocommerce-order-details">
						         <h2 class="woocommerce-order-details__title">Order details</h2>
						         <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
						            <thead>
						               <tr>
						                  <th class="woocommerce-table__product-name product-name">Product</th>
						                  <th class="woocommerce-table__product-table product-total">Total</th>
						               </tr>
						            </thead>
						            <tbody>
						            	@php
                                          $total = 0;
                                          foreach($order_items as $order_item)
                                          {	
                                          	$product = Product::find($order_item->product_id);
                                         	$name = str_replace(' ', '-', $product->name);
                                         	$total = $order_item->qty*$order_item->price;
                                        @endphp
							               <tr class="woocommerce-table__line-item order_item">
							                  <td class="woocommerce-table__product-name product-name">
							                     <a href="{{route('product.details',['id'=>@$product->id,'name'=>@$name])}}">{{$order_item->name}}</a> <strong class="product-quantity">×&nbsp;{{$order_item->qty}}</strong>	
							                  </td>
							                  <td class="woocommerce-table__product-total product-total">
							                     <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{$total}}</bdi></span>	
							                  </td>
							               </tr>
						               	@php
                                          }
                                       @endphp
						            </tbody>
						            <tfoot>
						               <tr>
						                  	<th scope="row">Payment method:</th>
						                  	<td>
						                  		@if($order->payment_method == 'cod')
							                  		Cash on delivery
							                  	@elseif($order->payment_method == 'bkash')
							                  		Bkash (Transaction Id : {{$order->bkash_transation_no}})
							                  	@endif
							              	</td>
						               </tr>
						               <tr>
						                  <th scope="row">Total:</th>
						                  <td>
						                  	<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">৳&nbsp;
						                  	</span>{{$order->total_amount}}</span>
						                  </td>
						               </tr>
						            </tfoot>
						         </table>
						      </section>
						      <section class="woocommerce-customer-details">
						         <section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
						            <!-- /.col-1 -->
						            <div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
						               <h2 class="woocommerce-column__title">Shipping address</h2>
						               <address>
						                  Name:  {{$order->name}}, <br>
						                  Phone: {{$order->phone}}, <br>
						                  Address: {{$order->shipping_address}}
						               </address>
						            </div>
						            <!-- /.col-2 -->
						         </section>
						         <!-- /.col2-set -->
						      </section>
						   </div>
						   <div class="large-5 col">
						      <div class="is-well col-inner entry-content">
						         <p class="success-color woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><strong>Thank you. Your order has been received.</strong></p>
						         <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
						            <li class="woocommerce-order-overview__order order">
						               Order number:						
						               <strong>{{$order->id}}</strong>
						            </li>
						            <li class="woocommerce-order-overview__date date">
						               Date:							
						               <strong>{{date('M d, Y',strtotime($order->created_at))}}</strong>
						            </li>
						            <li class="woocommerce-order-overview__email email">
						               Email:								
						               <strong>{{$order->email}}</strong>
						            </li>
						            <li class="woocommerce-order-overview__total total">
						               Shipping Charge:						
						               <strong>
						               	<span class="woocommerce-Price-amount amount">
						               		<bdi>
						               			<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>
						               			{{$order->shipping_charge}}
						               		</bdi>
						               	</span>
						               </strong>
						            </li>
						            <li class="woocommerce-order-overview__total total">
						               Total:						
						               <strong>
						               	<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{$order->total_amount}}</bdi></span>
						               </strong>
						            </li>
						            <li class="woocommerce-order-overview__payment-method method">
						               Payment method:							
						               <strong>
							               @if($order->payment_method == 'cod')
						                  		Cash on delivery
						                  	@elseif($order->payment_method == 'bkash')
						                  		Bkash
						                  	@endif
							           </strong>
						            </li>
						         </ul>
						         <div class="clear"></div>
						      </div>
						   </div>
						</div>
                    </div>
               </div>
            </div>
        </div>
@endsection
