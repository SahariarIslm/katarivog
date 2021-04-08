<?php

namespace App\Helper;

use DB;

use App\Category;
use App\ProductImage;
use App\Product;
use App\Review;
use App\Menu;


class GetData
{
    public static function GetCategoryListForMenu($id){
        $categories =  Category::where('parent',$id)
        						->where('showInMainMenu',1)
        						->where('categoryStatus',1)
        						->orderBy('orderBy','ASC')
        						->orderBy('categoryName','ASC')
        						->get();
        return $categories;
    }

    public static function GetCategoryListForSidebar($id){
        $categories =  Category::where('parent',$id)
								->where('showInSidebarCategory',1)
								->where('categoryStatus',1)
								->orderBy('orderBy','ASC')
								->orderBy('categoryName','ASC')
								->get();
        return $categories;
    }

    public static function GetCategoryBySection($productSectionId){
        $categories = Category::whereRaw('FIND_IN_SET(?,productSection)',$productSectionId)
        						->orderBy('orderBy','ASC')
        						->get();
        return $categories;
    }

    public static function GetProductListBySection($productSectionId){
        $data = DB::table('product_advance')
                  ->select('product_advance.productId','product_advance.productSection','products.*')
                  ->join('products','products.id','=','product_advance.productId')
                  ->whereRaw('FIND_IN_SET(?,product_advance.productSection)',$productSectionId)
                  ->where('status',1)
                  ->orderBy('orderBy','ASC')
                  ->get();
        return $data;
    }

    public static function GetSectionProductByCategory($productSectionId,$categoryId){
        $data = DB::table('product_advance')
                  ->select('product_advance.productId','product_advance.productSection','products.*')
                  ->join('products','products.id','=','product_advance.productId')
                  ->whereRaw('FIND_IN_SET(?,product_advance.productSection)',$productSectionId)
                  ->whereRaw('FIND_IN_SET(?,products.category_id)',$categoryId)
                  ->where('status',1)
                  ->orderBy('orderBy','ASC')
                  ->get();
        return $data;
    }

    public static function GetProductImage($productId,$section = null){
      if($section == null){
        $data = ProductImage::where('section','content')->where('productId',$productId)->first();
      }else{
        $data = ProductImage::where('section',$section)->where('productId',$productId)->first();
      }
      return $data;
    }

    public static function ProductDetailsLink($productId){
    	$product = Product::find($productId);
    	$name = str_replace(' ', '-', $product->name);
        $data = route('product.details',['id'=>$productId,'name'=>$name]);
        return $data;
    }

    public static function TotalReview($productId){
      $totalReview = Review::where('productId',$productId)->count();
      return $totalReview; 
    }

    public static function ProductReview($productId){
        $totalReview = Review::where('productId',$productId)->count();
        $totalRating = Review::where('productId',$productId)->sum('star');

        @$finalRating = round(@$totalRating/$totalReview);
        if(@$totalRating < 1){
         @$rating = 5; 
        }else{
          @$rating = $finalRating;
        }
        @$remainRating = 5 - $rating;
        $data = '';
        for($i = 0;$i < $rating;$i++){
	      $data .= '<i class="fa fa-star star-on" aria-hidden="true"></i>';
        }
	    for($i = 0;$i < $remainRating;$i++){
	     $data .= '<i class="fa fa-star star-of" aria-hidden="true"></i>';
	    }
	    
       return $data;
    }

    public static function StockCheck($id = null) {
        $stockOutReports = DB::table('stock_valuation_report')
                  ->select('products.id','products.stockUnit','stock_valuation_report.productId as productId', DB::raw('(((SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) - SUM(stock_valuation_report.purchaseReturnQty)) - ((SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty)) - SUM(stock_valuation_report.salesReturnQty))) as remainingQty'))
                  ->join('products','products.id','=','stock_valuation_report.productId')
                  ->where('products.stockUnit','1')
                  ->where('stock_valuation_report.productId',$id)
                  ->first();
        return $stockOutReports;
    }

    public static function MenuList($showin){
      $menuList = Menu::where('menuStatus',1)
                  ->orderBy('orderBy','asc')
                  ->where('parent',NULL)
                  ->where($showin,1)
                  ->get();
      return $menuList;
    }

    public static function SubMenuList($showin,$parentId){
      $sub_menuList = Menu::where('menuStatus',1)
                  ->orderBy('orderBy','asc')
                  ->where('parent',$parentId)
                  ->where($showin,1)
                  ->get();
      return $sub_menuList;
    }

    public static function CartTotal(){
      $total = \Cart::subtotal();
      return $total;
    }
}
