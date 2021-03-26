<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Session;

class ReviewController extends Controller
{
    public function customerReview(Request $request){

    	 $this->validate(request(), [
            'name' => 'required',
            'summary' => 'required',
            'review' => 'required',
            'star' => 'required',
        ]);

    	 $productId = $request->productId;
    	 $productName = $request->productName;
    	 $customerId = Session::get('customerId');

        $review = Review::create( [     
            'customerId' =>$customerId,           
            'productId' =>$request->productId,           
            'name' => $request->name,           
            'summary' => $request->summary,                     
            'review' => $request->review, 
            'star' => $request->star,            
            'status' => '0',            
              
        ]);

        return redirect(route('product.details',[$productId,'name'=>$productName,'setReview'=>$productId]))->with('msg','Review Complete Successfully');
    }
}
