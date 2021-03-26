<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\ProductAdvance;
use App\ShippingCharges;

use Cart;

class CartController extends Controller
{
    public function index()
    {   $title = 'Shopping Cart';
        return view('frontend.shopping_cart.index')->with(compact('title'));
    }

    public function addCart(Request $request){
        $products = Product::where('id',$request->productId)->first(); 
        $image = ProductImage::where('productId',@$request->productId)
                            ->where('section','content')
                            ->first();
        $cart =  Cart::add(['id' => $products->id, 
            'name' => $products->name, 
            'qty' => $request->qty, 
            'price' => $request->price, 
            'weight' => '0', 
            'options' => ['image' => $image->images, 
            'deal_code' => $products->deal_code]]);
            $subtotal = Cart::subtotal();
            $total = str_replace(',', '', $subtotal);
            
        return response()->json([
            'total'=>$total
        ]);
    } 

    public function update(Request $request)
    {   
        if($request->ajax())
        {
            Cart::update($request->rowId, $request->qty);
            print_r(1);       
            return;
        }
    }
  

    public function remove(Request $request)
    {  
        if($request->ajax())
        {
            Cart::remove($request->rowId);
            print_r(1);       
            return;
        }
       
    }

    //Show Product number in cart
    public function cartItemCount(Request $request){
        $carts =  Cart::count();
        if($request->ajax())
            {
                return response()->json([
                    'carts'=>$carts,
                    'mini_total'=>Cart::subtotal()
                ]);
            }
    }
    
    //Show each product in mini cart
    public function minicartProduct(Request $request){
        $data = "";
        $total = 0;
        $data .='<div class="cart-item product-summary">';
        if(Cart::count() > 0){
            foreach(Cart::content() as $carts)
            {
                $name = str_replace(' ', '-', $carts->name);
                if(file_exists($carts->options->image)){
                    $image = asset(@$carts->options->image);
                }else{
                    $image = asset('/public/frontend/no-image-icon.png');
                }

                $data .='<div class="row parentRow_'.$carts->rowId.'"">';
                $data .='<div class="col-xs-4">';
                $data .='<div class="image">';
                $data .='<a href="'.route('product.details',['id'=>@$carts->id,'name'=>@$name]).'">';
                $data .='<img src="'.$image.'" alt="">';
                $data .='</a>';
                $data .='</div>';
                $data .='</div>';
                $data .='<div class="col-xs-7">';
                $data .='<h3 class="name">';
                $data .='<a href="'.route('product.details',['id'=>@$carts->id,'name'=>@$name]).'" title="'.$carts->name.'">'.str_limit($carts->name,15).'</a>';
                $data .='</h3>';
                $data .='<div class="price">৳ '.$carts->price.'</div>';
                $data .='</div>';
                $data .='<div class="col-xs-1 action">';
                $data .='<a href="javascript:void(0)" onclick="removeCartRow('."'".$carts->rowId."'".')">';
                $data .='<i class="fa fa-trash"></i>';
                $data .='</a>';
                $data .='</div>';
                $data .='</div>';

                $total += $carts->subtotal;
            }

                $data .='</div>';
                $data .='<div class="clearfix"></div>';
                $data .='<hr>';
                $data .='<div class="clearfix cart-total">';
                $data .='<div class="pull-right">';
                $data .='<span class="text">Sub Total :</span>';
                $data .='<span class="price">৳ '.Cart::subtotal().'</span>';
                $data .='</div>';
                $data .='<div class="clearfix"></div>';
                $data .='<a href="'.route('cart.order').'" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>';
                $data .='</div>';


        }else{
            $data .='<span>Your Cart is Empty</span>';
            $data .='</div>';
        }

        echo $data;

    }

    //Show each product in main cart page
    public function MainCartProduct(Request $request){
        $data = "";
        $totalSummary = "";
        $total = 0;
        $checkOutBtn = '';
        if(Cart::count() < 1){
            $disabled = "disabled";
        }else{
            $disabled = "";
        }
            if(Cart::count() > 0){
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

                    $data .='<tr parentRow_'.$carts->rowId.'">';
                    $data .='<td class="romove-item">';
                    $data .='<a href="javascript:void(0)" title="cancel" class="icon" onclick="removeCartRow('."'".$carts->rowId ."'".')">';
                    $data .='<i class="fa fa-trash-o"></i></a>';
                    $data .='</a>';
                    $data .='</td>';
                    $data .='<td class="cart-image">';
                    $data .='<a class="entry-thumbnail" href="'.route('product.details',['id'=>@$carts->id,'name'=>@$name]).'">';
                    $data .='<img src="'.$image.'" alt="">';
                    $data .='</a>';
                    $data .='</td>';
                    $data .='<td class="cart-product-name-info">';
                    $data .='<h4 class="cart-product-description">';
                    $data .='<a href="'.route('product.details',['id'=>@$carts->id,'name'=>@$name]).'" title="'.$carts->name.'">'.$carts->name.'</a>';
                    $data .='</h4>';
                    $data .='</td>';
                    $data .='<td class="cart-product-quantity">';
                    $data .='<div class="cart-quantity">';
                    $data .='<div class="quant-input">';
                    $data .='<input type="number" id="inputQty_'.$carts->rowId.'" value="'.$carts->qty.'" min="1" style="width: 100px" oninput="UpdateShoppingCart('."'".$carts->rowId."'".')">';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='</td>';
                    $data .='<td class="cart-product-sub-total">';
                    $data .='<span class="cart-sub-total-price">৳ '.$carts->price.'</span>';
                    $data .='</td>';
                    $data .='<td class="cart-product-grand-total">';
                    $data .='<span class="cart-grand-total-price">৳ '.$carts->subtotal.'</span>';
                    $data .='</td>';
                    $data .='</tr>';

                    $total += $carts->subtotal;

                    $free_shipping = ProductAdvance::where('free_shipping','free')->where('productId',$carts->id)->first();

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

                $totalSummary .= '<th>';
                $totalSummary .= '<div class="cart-sub-total">';
                $totalSummary .= 'Subtotal<span class="inner-left-md">৳ '.Cart::subtotal().'</span>';
                $totalSummary .= '</div>';
                $totalSummary .= '<div class="cart-sub-total">';
                $totalSummary .= 'Shipping Charge<span class="inner-left-md">৳ '.number_format($shippingCharge, 2, '.', '').'</span>';
                $totalSummary .= '</div>';
                $totalSummary .= '<div class="cart-grand-total">';
                $totalSummary .= 'Grand Total<span class="inner-left-md">৳ '.number_format($grandTotal, 2, '.', '').'</span>';
                $totalSummary .= '</div>';
                $totalSummary .= '</th>';


                $checkOutBtn .= '<a href="'.route('cart.order').'" type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>';
            }

            return response()->json([
                    'cartProduct'=>$data,
                    'cartSummary'=>$totalSummary,
                    'checkOutBtn'=>$checkOutBtn,

                ]);

        }
        
}
