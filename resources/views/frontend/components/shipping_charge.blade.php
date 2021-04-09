<tr class="cart-subtotal">
 <th>Subtotal</th>
 <td>
  <span class="woocommerce-Price-amount amount">
    <bdi>
      <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>
      {{$total}}
    </bdi>
  </span>
</td>
</tr>
<tr class="woocommerce-shipping-totals shipping shipping--boxed">
 <td class="shipping__inner" colspan="2">
    <table class="shipping__table shipping__table--multiple">
       <tbody>
          <tr>
             <th colspan="2">Shipping</th>
             <td data-title="Shipping">
                <ul id="shipping_location" class="shipping__list woocommerce-shipping-methods">
                  <input type="hidden" name="shipping_charge">
                   <li class="shipping__list_item">
                      <input type="radio" name="shipping_location" value="60" id="shipping_location_0_flat_rate1" value="flat_rate:1" class="shipping_location" required>
                      <label class="shipping__list_label" for="shipping_location_0_flat_rate1">
                        Inside Dhaka: 
                        <span class="woocommerce-Price-amount amount">
                          <bdi>
                            <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>60
                          </bdi>
                        </span>
                      </label>                
                   </li>
                   <li class="shipping__list_item">
                      <input type="radio" name="shipping_location" value="150" id="shipping_location_0_flat_rate3" value="flat_rate:3" class="shipping_location">
                      <label class="shipping__list_label" for="shipping_location_0_flat_rate3">
                        Outside Dhaka: 
                        <span class="woocommerce-Price-amount amount">
                          <bdi>
                            <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>150
                          </bdi>
                        </span>
                      </label>                
                   </li>
                </ul>
             </td>
          </tr>
       </tbody>
    </table>
 </td>
</tr>
{{-- <tr class="fee">
 <th>10% Discount</th>
  <td>
    <span class="woocommerce-Price-amount amount">
      <bdi>-
        <span class="woocommerce-Price-currencySymbol">৳&nbsp;</span>49
      </bdi>
    </span>
  </td>
</tr> --}}

@section('custom_js')
<script type="text/javascript">
  $('input[name="shipping_location"]').on('change',function(){
    var shipping_charge = $(this).val();
    var total_amount = parseInt('{{$total}}') +   parseInt(shipping_charge)
    $('#total_amount').text(total_amount)
    $('input[name=shipping_charge]').val(shipping_charge)
    $('input[name=total_amount]').val(total_amount)
  });
</script>
  
@endsection