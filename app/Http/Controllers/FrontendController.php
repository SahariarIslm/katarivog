<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

use DB;
use Session;

use App\HeaderBlock;
use App\Policy;
use App\Category;
use App\Product;
use App\ProductAdvance;
use App\ProductSection;
use App\Slider;
use App\Settings;
use App\Article;
use App\Banner;
use App\Area;
use App\Blog;


class FrontendController extends Controller
{
  public function index()
  {    
    $setReview = @$_GET['setReview'];
    $metaInfo = Settings::first();
    $title = $metaInfo->siteTitle;
    $metaTag =[
      'meta_keyword'=>$metaInfo->metaKeyword,
      'meta_title' =>$metaInfo->metaTitle,
      'meta_description' =>$metaInfo->metaDescription
    ];

    $firstBannerList = Slider::where('status',1)->where('orderBy',1)->get();
    $secondBanner = Slider::where('status',1)->where('orderBy',2)->get();

    $policy_list = Policy::where('policiesStatus','1')->orderBy('orderBy','ASC')->get();

    

    $secondBannerList = Banner::where('bannerStatus',1)
                        ->orderBy('orderBy','ASC')
                        ->whereBetween('orderBy', [3, 3])
                        ->first();

    $topProductSectionList = ProductSection::where('status',1)
                            ->where('content_section','top_content')
                            ->orderBy('order_by','ASC')
                            ->get();

    $middleProductSectionList = ProductSection::where('status',1)
                            ->where('content_section','middle_content')
                            ->orderBy('order_by','ASC')
                            ->get();

    $bottomProductSectionList = ProductSection::where('status',1)
                            ->where('content_section','bottom_content')
                            ->orderBy('order_by','ASC')
                            ->get();

    $sidebarProductSectionList = ProductSection::where('status',1)
                            ->where('content_section','side_content')
                            ->orderBy('order_by','ASC')
                            ->get();
    $hotProductList = ProductAdvance::whereRaw('hotDiscount <> ""')
                      ->whereRaw('hotDate <> ""')
                      ->where('hotDate', '>=', date('d-m-Y'))
                      ->get();

    $specialProductList = ProductAdvance::whereRaw('specialDiscount <> ""')
                      ->whereRaw('specialDate <> ""')
                      ->where('specialDate', '>=', date('d-m-Y'))
                      ->get();
                                                                    
    $blogHeader = HeaderBlock::where('section','blogs')->where('articleStatus',1)->first();          
    $blogList = Blog::where('articleStatus',1)->orderBy('orderBy','ASC')->get();

    $category_list = Category::where('categoryStatus',1)->orderBy('orderBy','ASC')->get();

    return view('frontend.home.home')->with(compact('setReview','title','metaTag','policy_list','firstBannerList','secondBanner','secondBannerList','topProductSectionList','middleProductSectionList','blogHeader','blogList','bottomProductSectionList','sidebarProductSectionList','hotProductList','specialProductList','category_list'));
  }

  public function searchProduct(Request $request){
    $title = "Search";
    $search = $_GET['search_query'];

    $categories = @$request->categorySelect;
    if ($categories) {
      $products = Product::where('status',1)
                        ->where('name','LIKE','%'.$search.'%')
                        ->orWhere('deal_code','LIKE','%'.$search.'%')
                        ->paginate(10);
      $products->appends(['searchProduct' => $search]);
    }else{
      $products = Product::where('status',1)
                        ->where('name','LIKE','%'.$search.'%')
                        ->orWhere('deal_code','LIKE','%'.$search.'%')
                        ->paginate(10);
      $products->appends(['searchProduct' => $search]);
    }

    $categorySelect = Category::where('id',$categories)->first();

    return view('frontend.search.searchProduct')->with(compact('title','products','search','categorySelect'));
  }

  public function Page404(){
      return view('frontend.pages.page404');
  }
  public function about_us(){
      return view('frontend.pages.about_us');
  }
  public function contact_us(){
      return view('frontend.pages.contact_us');
  }
}