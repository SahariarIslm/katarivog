<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Cart;
use Session;
use DB;
use PDF;

use App\Order;
use App\OrderList;
use App\Customer;
use App\Product;

class OrderController extends Controller{
    public function OrderProcessing(){
        $title = "Order Processing";
        return view('frontend.shopping_cart.order_processing')->with(compact('title'));
    }


    public function OrderSuccess($id){
        $title = "Order Complete";
        $order = Order::find($id);
        $order_items = OrderList::where('order_id',$id)->get();
        return view('frontend.shopping_cart.ordersuccess')->with(compact('title','order','order_items'));
    }

    public function OrderSave(Request $request){
        $customerId = Session::get('customerId');

        if($request->email){
            $existCustomer = Customer::where('email',$request->email)->orWhere('mobile',$request->phone)->first();    
        }else{
            $existCustomer = Customer::where('mobile',$request->phone)->first();
        }

        if($request->name){

        }else{
            $request->name = $request->first_name." ".$request->last_name;
        }
        
        if($existCustomer){
            $customer = Customer::find($existCustomer->id);
            $customer->update( [
                'name'=>$request->name,
                'mobile'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->shipping_address,         
            ]);
        }else{
            $customer = Customer::create([
                'name'=>$request->name,
                'mobile'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->shipping_address,
            ]);
        } 

        $order = Order::create([
            'customer_id'=>$customer->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'shipping_address'=>$request->shipping_address,
            'shipping_charge'=>$request->shipping_charge,
            'payment_method'=>$request->payment_method,
            'bkash_transation_no'=>$request->bkash_transation_no,
            'total_amount'=>$request->total_amount,
            'status'=>'Waiting',
        ]);
        
        $total = 0;

        foreach(Cart::content() as $cart){
            $product=Product::find($cart->id);
            $orderList = OrderList::create([
                'order_id'=>$order->id,
                'customer_id'=>$customer->id,
                'product_id'=>$product->id,
                'name'=>$product->name,
                'code'=>$product->deal_code,
                'qty'=>$cart->qty,
                'price'=>$cart->price,
                'total'=>$cart->qty*$cart->price,
                'status'=>'',
            ]);
        }
        Cart::destroy();
        $title = "Order Complete";
        return redirect(route('order.success',$order->id))->with(compact('title'));
      
    }

    
}
