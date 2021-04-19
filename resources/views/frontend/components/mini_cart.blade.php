@php 
use Illuminate\Support\Str;
@endphp
<a href="https://milkybd.com/cart/" title="Cart" class="header-cart-link is-small">
   <span class="header-cart-title">
   Cart   /       
      <span class="cart-price">
         <span class="woocommerce-Price-amount amount">
            <bdi>
               <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{Cart::subtotal()}}
            </bdi>
         </span>
      </span>
   </span>
   <span class="cart-icon image-icon">
      <strong>{{Cart::count()}}</strong>
   </span>
</a>
   <ul class="nav-dropdown nav-dropdown-default" style="">
      <li class="html widget_shopping_cart">
         <div class="widget_shopping_cart_content">
            @if(Cart::count() > 0)
               <ul class="woocommerce-mini-cart cart_list product_list_widget ">
               @php
                  $total = 0;
                  foreach(Cart::content() as $carts)
                  {
                     $name = str_replace(' ', '-', $carts->name);
                     if(file_exists($carts->options->image)){
                       $image = asset(@$carts->options->image);
                     }else{
                        $image = asset('/public/frontend/no-image-icon.png');
                     }
                     $total += $carts->subtotal;
               @endphp
                  <li class="woocommerce-mini-cart-item mini_cart_item">
                     <a href="javascript:" class="remove remove_from_cart_button" aria-label="Remove this item" onclick="RemoveCartProduct('{{$carts->rowId}}')" >×</a>                     
                     <a href="{{route('product.details',['id'=>@$carts->id,'name'=>@$name])}}">
                        <img width="300" height="300" src="{{$image}}
                        " class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" srcset="{{$image}} 300w">{{str::limit($carts->name,15)}}           
                     </a>
                     <span class="quantity">{{$carts->qty}} × 
                        <span class="woocommerce-Price-amount amount">
                           <bdi>
                              <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>{{$carts->price}}
                           </bdi>
                        </span>
                     </span>        
                  </li>
               @php } @endphp
               </ul>
               <p class="woocommerce-mini-cart__total total">
                  <strong>Subtotal:</strong> 
                  <span class="woocommerce-Price-amount amount">
                     <bdi>
                        <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>
                        {{Cart::subtotal()}}
                     </bdi>
                  </span> 
               </p>
               <p class="woocommerce-mini-cart__buttons buttons">
                  <a href="{{route('cart.index')}}" class="button wc-forward">View cart</a>
                  <a href="{{route('cart.order')}}" class="button checkout wc-forward">Checkout</a>
               </p>

            @else
               <p class="woocommerce-mini-cart__empty-message">
                 No products in the cart.
               </p>
            @endif
         </div>
      </li>
   </ul>