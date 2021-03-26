<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use DB;

use App\Category;
use App\Product;
use App\ProductImage;

class CategoryController extends Controller
{
  public function ProductByCategory($id){
     $category = Category::where('id',$id)->first();
     $metaTag =[
        'meta_keyword'=>$category->metaKeyword,
        'meta_title' =>$category->metaTitle,
        'meta_description' =>$category->metaDescription
     ];

     $title = $category->categoryName;

     return view('frontend.category.productbycategory')->with(compact('metaTag','title','category'));
  }

  public function GetCategoryProduct(Request $request){
    $lowerPrice = $request->lowerPrice;
    $higherPrice = $request->higherPrice;
    $sortingBy = $request->sortingBy;
    $sortingOrder = $request->sortingOrder;
    $productLimit = $request->productLimit;
    $limit = $request->productLimit;

    $paginate = "";

    if($request->productLimit != null && $request->productLimit == 0){
      $productList = Product::whereRaw('FIND_IN_SET(?,category_id)',[$request->categoryId])
                    ->where('status',1)
                    ->whereBetween('price', [$lowerPrice, $higherPrice])
                    ->orderBy(@$sortingBy,@$sortingOrder)
                    ->get();
    }else{
      $productList = Product::whereRaw('FIND_IN_SET(?,category_id)',[$request->categoryId])
                  ->where('status',1)
                  ->orderBy($sortingBy,$sortingOrder)
                  ->whereBetween('price', [$lowerPrice, $higherPrice])
                  ->paginate($limit);
      $paginate .= $productList->links();
  }

    $gridProduct = "";
    $listProduct = "";
    if(count($productList) > 0){
      foreach ($productList as $product) {
        $getImage = \App\Helper\GetData::GetProductImage($product->id);
        $getProductDetailsLink = \App\Helper\GetData::ProductDetailsLink($product->id);
        $getProductReview = \App\Helper\GetData::ProductReview($product->id);

        $stockCheck = \App\Helper\GetData::StockCheck($product->id);
        if($stockCheck->id != NULL && $stockCheck->remainingQty == 0 || $stockCheck->remainingQty < 0){
          $disabled = "disabled";
          $availability = "Out of Stock";
          $availabilityColor = "red";
        }else{
          $disabled = "";
          $availability = "In Stock";
          $availabilityColor = "green";
        }

        if($product->discount){
          $price = $product->discount;
        }else{
          $price = $product->price;
        }

        $name = str_replace(' ', '-', $product->name);
        
        if(file_exists(@$getImage->images)){
            $image = asset($getImage->images);
        }else{
            $image = asset('/public/frontend/no-image-icon.png');
        }

        $gridProduct .='<div class="col-sm-6 col-md-4 wow fadeInUp">';
        $gridProduct .='<div class="products">';
        $gridProduct .='<div class="product">';
        $gridProduct .='<div class="product-image">';
        $gridProduct .='<div class="image">';
        $gridProduct .='<a href="'.$getProductDetailsLink.'">';
        $gridProduct .='<img  src="'.$image.'" alt="">';
        $gridProduct .='</a>';
        $gridProduct .='</div>';
        $gridProduct .='</div>';

        $gridProduct .='<div class="product-info text-left">';
        $gridProduct .='<h3 class="name">';
        $gridProduct .='<a href="'.$getProductDetailsLink.'">'.str_limit($product->name,35);
        $gridProduct .='</a>';
        $gridProduct .='</h3>';
        $gridProduct .='<div class="rating">'.$getProductReview;
        $gridProduct .='</div>';
        $gridProduct .='<div class="description"></div>';

        if($product->discount){
          $gridProduct .='<div class="product-price">';
          $gridProduct .='<span class="price"> ৳ '.$product->discount.' </span>';
          $gridProduct .='<span class="price-before-discount"> ৳ '.$product->price.' </span>';
          $gridProduct .='</div>';
        }else{
          $gridProduct .='<div class="product-price">';
          $gridProduct .='<span class="price"> ৳ '.$product->price.' </span>';
          $gridProduct .='</div>';
        }

        $gridProduct .='</div>';

        $gridProduct .='<div class="cart clearfix animate-effect">';
        $gridProduct .='<div class="action">';
        $gridProduct .='<ul class="list-unstyled">';
        $gridProduct .='<li class="add-cart-button btn-group">';
        $gridProduct .='<button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart" '.$disabled.' onclick="addCart('. $product->id.','.$price.')">';
        $gridProduct .='<i class="fa fa-shopping-cart"></i>';
        $gridProduct .='</button>';
        $gridProduct .='<button class="btn btn-primary cart-btn" type="button">';
        $gridProduct .='Add to cart';
        $gridProduct .='</button>';
        $gridProduct .='</li>';
        $gridProduct .='<li class="lnk wishlist">';
        $gridProduct .='<a data-toggle="tooltip" class="add-to-cart" href= "" title="Wishlist">';
        $gridProduct .='<i class="icon fa fa-heart"></i>';
        $gridProduct .='</a>';
        $gridProduct .='</li>';
        $gridProduct .='<li class="lnk">';
        $gridProduct .='<a data-toggle="tooltip" class="add-to-cart" href= "" title="Compare">';
        $gridProduct .='<i class="fa fa-signal" aria-hidden="true"></i>';
        $gridProduct .='</a>';
        $gridProduct .='</li>';
        $gridProduct .='</ul>';
        $gridProduct .='</div>';
        $gridProduct .='</div>';
        $gridProduct .='</div>';
        $gridProduct .='</div>';
        $gridProduct .='</div>';
        $gridProduct .='</div>'; // product for grid view


        $listProduct .='<div class="category-product-inner wow fadeInUp">'; // product for list view
        $listProduct .='<div class="products">';
        $listProduct .='<div class="product-list product">';
        $listProduct .='<div class="row product-list-row">';
        $listProduct .='<div class="col col-sm-4 col-lg-4">';
        $listProduct .='<div class="product-image">';
        $listProduct .='<div class="image">';
        $listProduct .='<a href="'.$getProductDetailsLink.'">';
        $listProduct .='<img  src="'.$image.'" alt="">';
        $listProduct .='</a>';
        $listProduct .='</div>';
        $listProduct .='</div>';
        $listProduct .='</div>';

        $listProduct .='<div class="col col-sm-8 col-lg-8">';
        $listProduct .='<div class="product-info">';
        $listProduct .='<h3 class="name">';
        $listProduct .='<a href="'.$getProductDetailsLink.'">'.str_limit($product->name,35);
        $listProduct .='</a>';
        $listProduct .='</h3>';
        $listProduct .='<div class="rating">'.$getProductReview;
        $listProduct .='</div>';

        if($product->discount){
          $listProduct .='<div class="product-price">';
          $listProduct .='<span class="price"> ৳ '.$product->discount.' </span>';
          $listProduct .='<span class="price-before-discount"> ৳ '.$product->price.' </span>';
          $listProduct .='</div>';
        }else{
          $listProduct .='<div class="product-price">';
          $listProduct .='<span class="price"> ৳ '.$product->price.' </span>';
          $listProduct .='</div>';
        }

        $listProduct .='<div class="description m-t-10">'.str_limit($product->description1,500).'</div>';
        $listProduct .='<div class="cart clearfix animate-effect">';
        $listProduct .='<div class="action">';
        $listProduct .='<ul class="list-unstyled">';
        $listProduct .='<li class="add-cart-button btn-group" onclick="addCart('. $product->id.','.$price.')">';
        $listProduct .='<button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i></button>';
        $listProduct .='<button class="btn btn-primary cart-btn" type="button">Add to cart</button>';
        $listProduct .='</li>';
        $listProduct .='<li class="lnk wishlist">';
        $listProduct .='<a class="add-to-cart" href= "" title="Wishlist">';
        $listProduct .='<i class="icon fa fa-heart"></i>';
        $listProduct .='</a>';
        $listProduct .='</li>';
        $listProduct .='<li class="lnk">';
        $listProduct .='<a class="add-to-cart" href= "" title="Compare">';
        $listProduct .='<i class="fa fa-signal"></i>';
        $listProduct .='</a>';
        $listProduct .='</li>';
        $listProduct .='</ul>';
        $listProduct .='</div>';
        $listProduct .='</div>';
        $listProduct .='</div>';
        $listProduct .='</div>';
        $listProduct .='</div>';
        $listProduct .='</div>';
        $listProduct .='</div>';
        $listProduct .='</div>';
      }
    }else{
      $gridProduct .='<div>';
      $gridProduct .='<h3 style="text-align: center;">There is no product available of your request</h3>';
      $gridProduct .='</div">';

      $listProduct .='<div>';
      $listProduct .='<h3 style="text-align: center;">There is no product available of your request</h3>';
      $listProduct .='</div">';
    }


    return response()->json([
            'gridProduct'=>$gridProduct,
            'listProduct'=>$listProduct,
            'productLimit'=>$limit,
            'categoryProductPaginate'=>@$paginate 
        ]);
  }
}
