@if(Cart::count() > 0)
   <div class="woocommerce row row-large row-divided">
      <div class="col large-7 pb-0 ">
         <form class="woocommerce-cart-form" action="{{route('carts.update')}}" id="shopping_cart_form" method="post">
            <div class="cart-wrapper sm-touch-scroll">
               <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                  <thead>
                     <tr>
                        <th class="product-name" colspan="3">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-subtotal">Subtotal</th>
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
                        <tr class="woocommerce-cart-form__cart-item cart_item">
                           <td class="product-remove">
                              <a href="javascrpt:" class="remove" aria-label="Remove this item" onclick="RemoveCartProduct('{{$carts->rowId}}')">×</a>                       
                           </td>
                           <td class="product-thumbnail">
                              <a href="{{route('product.details',['id'=>@$carts->id,'name'=>@$name])}}">
                                 <img width="300" height="300" src="{{$image}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" srcset="{{$image}} 300w" sizes="(max-width: 300px) 100vw, 300px"></a>                       
                           </td>
                           <td class="product-name" data-title="Product">
                              <a href="{{route('product.details',['id'=>@$carts->id,'name'=>@$name])}}">
                                 {{$carts->name}}
                              </a>                          
                              <div class="show-for-small mobile-product-price">
                                 <span class="mobile-product-price__qty"> x </span>
                                 <span class="woocommerce-Price-amount amount">
                                    <bdi>
                                       <span class="woocommerce-Price-currencySymbol">
                                          ৳&nbsp;
                                       </span>
                                       {{$carts->price}}
                                    </bdi>
                                 </span>                            
                              </div>
                           </td>
                           <td class="product-price" data-title="Price">
                              <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{$carts->price}}</bdi></span>                        
                           </td>
                           <td class="product-quantity" data-title="Quantity">
                              <div class="quantity buttons_added">
                                 <input type="button" value="-" class="minus button is-form">         
                                 <label class="screen-reader-text" for="quantity_606dd1ba37bed">
                                    {{$carts->name}}
                                 </label>
                                 <input type="number" class="input-text qty text" step="1" min="0" max="" name="qty[]" value="{{$carts->qty}}" title="Qty" size="4" placeholder="" inputmode="numeric">

                                 <input type="hidden" name="rowId[]" value="{{$carts->rowId}}">
                                 <input type="button" value="+" class="plus button is-form"> 
                              </div>
                           </td>
                           <td class="product-subtotal" data-title="Subtotal">
                              <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{$carts->subtotal}}</bdi></span>                        
                           </td>
                        </tr>
                     @php
                        }
                     @endphp
                     <tr>
                        <td colspan="6" class="actions clear">
                           <div class="continue-shopping pull-left text-left">
                              <a class="button-continue-shopping button primary is-outline" href="{{url('/')}}">
                                 ←&nbsp;Continue shopping         
                              </a>
                           </div>
                           <button type="submit" class="button primary mt-0 pull-left small" name="update_cart" value="Update cart">
                              Update cart
                           </button>            
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </form>
      </div>
      <div class="cart-collaterals large-5 col pb-0">
         <div class="is-sticky-column" style="">
            <div class="is-sticky-column__inner" style="position: relative; transform: translate3d(0px, 0px, 0px);">
               <div class="cart-sidebar col-inner ">
                  <div class="cart_totals ">
                     <table cellspacing="0">
                        <thead>
                           <tr>
                              <th class="product-name" colspan="2" style="border-width:3px;">Cart totals</th>
                           </tr>
                        </thead>
                     </table>
                     <h2>Cart totals</h2>
                     <table cellspacing="0" class="shop_table shop_table_responsive">
                        <tbody>
                           {{-- <tr class="cart-subtotal">
                              <th>Subtotal</th>
                              <td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>150</bdi></span></td>
                           </tr> --}}{{-- 
                           <tr class="woocommerce-shipping-totals shipping shipping--boxed">
                              <td class="shipping__inner" colspan="2">
                                 <table class="shipping__table shipping__table--multiple">
                                    <tbody>
                                       <tr>
                                          <th colspan="2">Shipping</th>
                                          <td data-title="Shipping">
                                             <ul id="shipping_method" class="shipping__list woocommerce-shipping-methods">
                                                <li class="shipping__list_item">
                                                   <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_flat_rate1" value="flat_rate:1" class="shipping_method" checked="checked"><label class="shipping__list_label" for="shipping_method_0_flat_rate1">Inside Dhaka: <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>40</bdi></span></label>                               
                                                </li>
                                                <li class="shipping__list_item">
                                                   <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_flat_rate3" value="flat_rate:3" class="shipping_method"><label class="shipping__list_label" for="shipping_method_0_flat_rate3">Outside Dhaka: <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>150</bdi></span></label>                               
                                                </li>
                                                <li class="shipping__list_item">
                                                   <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_wbs106c98f512_outside_dhaka_city_wbs" value="wbs:10:6c98f512_outside_dhaka_city_wbs" class="shipping_method"><label class="shipping__list_label" for="shipping_method_0_wbs106c98f512_outside_dhaka_city_wbs">Outside Dhaka City WBS: <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>160</bdi></span></label>                               
                                                </li>
                                                <li class="shipping__list_item">
                                                   <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_wbs10ab371c5c_gazipur_savar_tongi_narayanganj_wbs" value="wbs:10:ab371c5c_gazipur_savar_tongi_narayanganj_wbs" class="shipping_method"><label class="shipping__list_label" for="shipping_method_0_wbs10ab371c5c_gazipur_savar_tongi_narayanganj_wbs">Gazipur, Savar, Tongi, Narayanganj WBS: <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>90</bdi></span></label>                             
                                                </li>
                                             </ul>
                                             <p class="woocommerce-shipping-destination">
                                                Shipping to <strong>Dhaka</strong>.                             
                                             </p>
                                             <form class="woocommerce-shipping-calculator" action="https://milkybd.com/cart/" method="post">
                                                <a href="#" class="shipping-calculator-button">Change address</a>
                                                <section class="shipping-calculator-form" style="display:none;">
                                                   <p class="form-row form-row-wide" id="calc_shipping_country_field">
                                                      <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select" rel="calc_shipping_state">
                                                         <option value="default">Select a country / region…</option>
                                                         <option value="BD" selected="selected">Bangladesh</option>
                                                      </select>
                                                   </p>
                                                   <p class="form-row validate-required form-row-wide address-field" id="calc_shipping_state_field">
                                                      <span>
                                                         <select name="calc_shipping_state" class="state_select" id="calc_shipping_state" data-placeholder="District" placeholder="District">
                                                            <option value="">Select an option…</option>
                                                            <option value="BD-05">Bagerhat</option>
                                                            <option value="BD-01">Bandarban</option>
                                                            <option value="BD-02">Barguna</option>
                                                            <option value="BD-06">Barishal</option>
                                                            <option value="BD-07">Bhola</option>
                                                            <option value="BD-03">Bogura</option>
                                                            <option value="BD-04">Brahmanbaria</option>
                                                            <option value="BD-09">Chandpur</option>
                                                            <option value="BD-10">Chattogram</option>
                                                            <option value="BD-12">Chuadanga</option>
                                                            <option value="BD-11">Cox's Bazar</option>
                                                            <option value="BD-08">Cumilla</option>
                                                            <option value="BD-13">Dhaka</option>
                                                            <option value="BD-14">Dinajpur</option>
                                                            <option value="BD-15">Faridpur </option>
                                                            <option value="BD-16">Feni</option>
                                                            <option value="BD-19">Gaibandha</option>
                                                            <option value="BD-18">Gazipur</option>
                                                            <option value="BD-17">Gopalganj</option>
                                                            <option value="BD-20">Habiganj</option>
                                                            <option value="BD-21">Jamalpur</option>
                                                            <option value="BD-22">Jashore</option>
                                                            <option value="BD-25">Jhalokati</option>
                                                            <option value="BD-23">Jhenaidah</option>
                                                            <option value="BD-24">Joypurhat</option>
                                                            <option value="BD-29">Khagrachhari</option>
                                                            <option value="BD-27">Khulna</option>
                                                            <option value="BD-26">Kishoreganj</option>
                                                            <option value="BD-28">Kurigram</option>
                                                            <option value="BD-30">Kushtia</option>
                                                            <option value="BD-31">Lakshmipur</option>
                                                            <option value="BD-32">Lalmonirhat</option>
                                                            <option value="BD-36">Madaripur</option>
                                                            <option value="BD-37">Magura</option>
                                                            <option value="BD-33">Manikganj </option>
                                                            <option value="BD-39">Meherpur</option>
                                                            <option value="BD-38">Moulvibazar</option>
                                                            <option value="BD-35">Munshiganj</option>
                                                            <option value="BD-34">Mymensingh</option>
                                                            <option value="BD-48">Naogaon</option>
                                                            <option value="BD-43">Narail</option>
                                                            <option value="BD-40">Narayanganj</option>
                                                            <option value="BD-42">Narsingdi</option>
                                                            <option value="BD-44">Natore</option>
                                                            <option value="BD-45">Nawabganj</option>
                                                            <option value="BD-41">Netrakona</option>
                                                            <option value="BD-46">Nilphamari</option>
                                                            <option value="BD-47">Noakhali</option>
                                                            <option value="BD-49">Pabna</option>
                                                            <option value="BD-52">Panchagarh</option>
                                                            <option value="BD-51">Patuakhali</option>
                                                            <option value="BD-50">Pirojpur</option>
                                                            <option value="BD-53">Rajbari</option>
                                                            <option value="BD-54">Rajshahi</option>
                                                            <option value="BD-56">Rangamati</option>
                                                            <option value="BD-55">Rangpur</option>
                                                            <option value="BD-58">Satkhira</option>
                                                            <option value="BD-62">Shariatpur</option>
                                                            <option value="BD-57">Sherpur</option>
                                                            <option value="BD-59">Sirajganj</option>
                                                            <option value="BD-61">Sunamganj</option>
                                                            <option value="BD-60">Sylhet</option>
                                                            <option value="BD-63">Tangail</option>
                                                            <option value="BD-64">Thakurgaon</option>
                                                         </select>
                                                      </span>
                                                   </p>
                                                   <p class="form-row validate-required form-row-wide address-field" id="calc_shipping_city_field">
                                                      <input type="text" class="input-text" value="" placeholder="Town / City" name="calc_shipping_city" id="calc_shipping_city" data-placeholder="Town / City">
                                                   </p>
                                                   <p class="form-row form-row-wide address-field" id="calc_shipping_postcode_field">
                                                      <input type="text" class="input-text" value="" placeholder="Postcode / ZIP" name="calc_shipping_postcode" id="calc_shipping_postcode" data-placeholder="Postcode / ZIP">
                                                   </p>
                                                   <p><button type="submit" name="calc_shipping" value="1" class="button">Update</button></p>
                                                   <input type="hidden" id="woocommerce-shipping-calculator-nonce" name="woocommerce-shipping-calculator-nonce" value="732fda0c76"><input type="hidden" name="_wp_http_referer" value="/cart/">    
                                                </section>
                                             </form>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr> --}}
                           <tr class="order-total">
                              <th>Total</th>
                              <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{Cart::subtotal()}}</bdi></span></strong> </td>
                           </tr>
                        </tbody>
                     </table>
                     <div class="wc-proceed-to-checkout">
                        <a href="https://milkybd.com/checkout/" class="checkout-button button alt wc-forward">
                        Proceed to checkout</a>
                     </div>
                  </div>{{-- 
                  <form class="checkout_coupon mb-0" method="post">
                     <div class="coupon">
                        <h3 class="widget-title"><i class="icon-tag"></i> Coupon</h3>
                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code"> <input type="submit" class="is-form expand" name="apply_coupon" value="Apply coupon">
                     </div>
                  </form> --}}
                  <div class="cart-sidebar-content relative"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
@else
   <div class="pt woocommerce-notices-wrapper">
      <p class="cart-empty woocommerce-info text-center" style="font-size: 25px;margin-bottom: 0px;">
         Your cart is currently empty.
      </p>
   </div>
   <div class="woocommerce">
      <div class="text-center pt pb">
            <div class="woocommerce-notices-wrapper"></div>    
            <p class="return-to-shop">
            <a class="button primary wc-backward" href="{{url('/')}}">
               Return to shop       
            </a>
         </p>
      </div>
   </div>
@endif