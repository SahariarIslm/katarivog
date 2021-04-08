@extends('frontend.master') 

@section('content')
  <div class="container-width">
    @include('frontend.components.cart_breadcrumb')
      <div class="row">
        <div id="content" class="large-12 col" role="main">
          <div class="woocommerce">
            <div class="woocommerce-notices-wrapper"></div>

              @include('frontend.components.checkout_login')

              <div class="woocommerce-notices-wrapper"></div>
              <form name="checkout" method="post" class="checkout woocommerce-checkout " action="{{route('order.save')}}" enctype="multipart/form-data">
                @csrf
                <div class="row pt-0 ">
                  <div class="large-7 col">

                    @include('frontend.components.checkout_social_login')

                      <div style="clear:both; margin-bottom: 6px"></div>
                      <div id="customer_details">
                        <div class="clear">
                           <div class="woocommerce-billing-fields">
                              <h3>Shipping Address</h3>
                              <div class="woocommerce-billing-fields__field-wrapper">
                                <p class="form-row form-row-first">
                                  <label for="first_name">First name
                                    <abbr class="required">*</abbr>
                                  </label>
                                  <span class="woocommerce-input-wrapper">
                                    <input type="text" class="input-text" name="first_name" id="first_name" required>
                                  </span>
                                </p>

                                <p class="form-row form-row-last">
                                  <label for="last_name">Last name
                                    <abbr class="required">*</abbr>
                                  </label>
                                  <span class="woocommerce-input-wrapper">
                                    <input type="text" class="input-text" name="last_name" id="last_name" required>
                                  </span>
                                </p>

                                <p class="form-row form-row-first">
                                  <label for="email">Email Address
                                    <abbr class="required">*</abbr>
                                  </label>
                                  <span class="woocommerce-input-wrapper">
                                    <input type="email" class="input-text" name="email" id="email" required>
                                  </span>
                                </p>

                                <p class="form-row form-row-last">
                                  <label for="phone">Phone
                                    <abbr class="required">*</abbr>
                                  </label>
                                  <span class="woocommerce-input-wrapper">
                                    <input type="text" class="input-text" name="phone" id="phone" required>
                                  </span>
                                </p>

                                <p class="form-row">
                                  <label for="address">Address
                                    <abbr class="required">*</abbr>
                                  </label>
                                  <span class="woocommerce-input-wrapper">
                                    <textarea name="shipping_address" required rows="3"></textarea> 
                                  </span>
                                </p>

                              </div>
                           </div>
                        </div>
                      </div>
                  </div>
                  <div class="large-5 col">
                     <div class="is-sticky-column" style="">
                        <div class="is-sticky-column__inner" style="position: relative; transform: translate3d(0px, 0px, 0px);">
                          <div class="col-inner ">
                            <div class="checkout-sidebar sm-touch-scroll">
                             <h3 id="order_review_heading">Your order</h3>
                               <div id="order_review" class="woocommerce-checkout-review-order">
                                  <table class="shop_table woocommerce-checkout-review-order-table" style="position: static; zoom: 1;">
                                      <thead>
                                        <tr>
                                           <th class="product-name">Product</th>
                                           <th class="product-total">Subtotal</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                          $total = 0;
                                          foreach(Cart::content() as $carts)
                                          {
                                             $name = str_replace(' ', '-', $carts->name);
                                             if(file_exists($carts->options->image))
                                             {
                                                $image = asset('/'.@$carts->options->image);
                                             }
                                             else
                                             {
                                                $image = asset('/public/frontend/no-image-icon.png');
                                             }
                                             $total += $carts->subtotal;
                                        @endphp
                                          <tr class="cart_item">
                                             <td class="product-name">
                                                {{$carts->name}}&nbsp;            
                                                <strong class="product-quantity">×&nbsp;{{$carts->qty}}</strong>                     
                                             </td>
                                             <td class="product-total">
                                                <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{$carts->subtotal}}</bdi></span>         
                                             </td>
                                          </tr>
                                        @php
                                          }
                                       @endphp
                                      </tbody>
                                      <tfoot>
                                        {{-- <tr class="cart-subtotal">
                                           <th>Subtotal</th>
                                           <td><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>490</bdi></span></td>
                                        </tr> --}}
                                        {{-- <tr class="woocommerce-shipping-totals shipping shipping--boxed">
                                           <td class="shipping__inner" colspan="2">
                                              <table class="shipping__table shipping__table--multiple">
                                                 <tbody>
                                                    <tr>
                                                       <th colspan="2">Shipping</th>
                                                       <td data-title="Shipping">
                                                          <ul id="shipping_method" class="shipping__list woocommerce-shipping-methods">
                                                             <li class="shipping__list_item">
                                                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_flat_rate1" value="flat_rate:1" class="shipping_method"><label class="shipping__list_label" for="shipping_method_0_flat_rate1">Inside Dhaka: <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>40</bdi></span></label>                
                                                             </li>
                                                             <li class="shipping__list_item">
                                                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_flat_rate3" value="flat_rate:3" class="shipping_method"><label class="shipping__list_label" for="shipping_method_0_flat_rate3">Outside Dhaka: <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>150</bdi></span></label>                
                                                             </li>
                                                             <li class="shipping__list_item">
                                                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_wbs106c98f512_outside_dhaka_city_wbs" value="wbs:10:6c98f512_outside_dhaka_city_wbs" class="shipping_method" checked="checked"><label class="shipping__list_label" for="shipping_method_0_wbs106c98f512_outside_dhaka_city_wbs">Outside Dhaka City WBS: <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>160</bdi></span></label>                
                                                             </li>
                                                             <li class="shipping__list_item">
                                                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_wbs10ab371c5c_gazipur_savar_tongi_narayanganj_wbs" value="wbs:10:ab371c5c_gazipur_savar_tongi_narayanganj_wbs" class="shipping_method"><label class="shipping__list_label" for="shipping_method_0_wbs10ab371c5c_gazipur_savar_tongi_narayanganj_wbs">Gazipur, Savar, Tongi, Narayanganj WBS: <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>90</bdi></span></label>                
                                                             </li>
                                                          </ul>
                                                       </td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                           </td>
                                        </tr>
                                        <tr class="fee">
                                           <th>10% Discount</th>
                                           <td><span class="woocommerce-Price-amount amount"><bdi>-<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>49</bdi></span></td>
                                        </tr> --}}
                                        <tr class="order-total">
                                           <th>Total</th>
                                           <td>
                                              <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                  <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{$total}}
                                                  </bdi>
                                                </span>
                                              </strong> 
                                              <input type="hidden" name="total_amount" value="{{$total}}">
                                            </td>
                                        </tr>
                                     </tfoot>
                                  </table>
                                  <div id="payment" class="woocommerce-checkout-payment">
                                     <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_cod">
                                          <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" required>
                                          <label for="payment_method_cod">
                                            Cash on delivery  
                                          </label>
                                          <div class="payment_box payment_method_cod" style="margin-left: 32px;">
                                            <p>Pay with cash upon delivery.</p>
                                          </div>
                                        </li>

                                        <li class="wc_payment_method payment_method_bkash">
                                          <input id="payment_method_bkash" type="radio" class="input-radio" name="payment_method" value="bkash">
                                          <label for="payment_method_bkash">
                                            Bkash(Write your bkash transaction id)
                                          </label>
                                          <div class="payment_box payment_method_bkash" style="margin-left: 32px;">
                                            <input type="text" name="bkash_transation_no" placeholder="write your bkash transaction id">
                                          </div>
                                        </li>
                                     </ul>
                                     <div class="form-row place-order">
                                        <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">
                                          Place order
                                        </button>
                                     </div>
                                  </div>
                               </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                </div>
             </form>
          </div>
        </div>
      </div>
  </div>
@endsection
