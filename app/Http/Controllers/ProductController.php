<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

use DB;
use Session;
use App\Product;
use App\ProductAdvance;
use App\ProductImage;
use App\Category;
use App\Review;

class ProductController extends Controller
{
  public function ProductDetails($id){
    $product = Product::where('id',$id)->first();
    $product_images = ProductImage::where('productId',$id)->where('section','content')->get();
    $productSection = ProductAdvance::where('productId',@$product->id)->first();
    $relatedProduct = explode(',', $productSection->related_product);
    $relatedProductList = Product::whereIn('id',$relatedProduct)
                                        ->where('status',1)
                                        ->orderBy('orderBy',"ASC")
                                        ->get();
    $reviews = Review::where('status','1')->where('productId',$id)->get();

    $category = Category::where('id',$product->category_id)->first();
    $title = $product->name;

    $hotProductList = ProductAdvance::whereRaw('hotDiscount <> ""')
                      ->whereRaw('hotDate <> ""')
                      ->where('hotDate', '>=', date('d-m-Y'))
                      ->get();

    $metaTag =[
      'meta_keyword'=>$product->metaKeyword,
      'meta_title' =>$product->metaTitle,
      'meta_description' =>$product->metaDescription
    ];

    $title = $product->name;
    return view('frontend.product.product_details')->with(compact('metaTag','title','product','product_images','reviews','relatedProductList','hotProductList'));
  }
}
