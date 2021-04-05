<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Category;
use App\ProductSection;

class ShopController extends Controller
{
    public function index(){
    	$category_list = Category::where('categoryStatus',1)->orderBy('orderBy','ASC')->get();
        $getProductList = DB::table('product_advance')
                  ->select('product_advance.productId','product_advance.productSection','products.*')
                  ->join('products','products.id','=','product_advance.productId')
                  ->where('status',1)
                  ->orderBy('orderBy','ASC')
                  ->get();
    	return view('frontend.category.shop')->with(compact('category_list','getProductList'));
    }
}
