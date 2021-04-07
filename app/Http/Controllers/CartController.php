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
        $rowId = $request->rowId;

        for ($i=0; $i < count($request->rowId); $i++) { 
            Cart::update($request->rowId[$i], $request->qty[$i]);
                
        } 

        return 1;
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
    
    public function cartView(){
        $mini_cart = (string)view('frontend.components.mini_cart');
        $main_cart = (string)view('frontend.components.main_cart');

        return response()->json([
            'mini_cart'=>$mini_cart,
            'main_cart'=>$main_cart,
        ]);
        }
        
}
