<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Article;
use App\Menu;
use App\Blog;
use App\Faq;

class PageController extends Controller
{

  public function Page($menuName,$menuId){ 
    $customerId = Session::get('customerId');
    $menu = Menu::where('id',$menuId)->first();
    $title = $menu->menuName;

    if($menuId == 4){
      if($customerId){
       return redirect(route('customer.profile',$customerId))->with(compact('title')); 
      }else{
        return redirect(route('customer.login'))->with(compact('title'));
      }
      
    }elseif($menuId == 5){
      if(isset($customerId)){
        return redirect(route('customer.order'))->with(compact('title'));
      }else{
        return view('frontend.order.shippingEmail')->with(compact('title'));
      }
    }elseif($menuId == 6){
      $faqList = Faq::where('status',1)->get();
      return view('frontend.faq.index')->with(compact('title','faqList'));

    }elseif($menuId == 14){
      $blogList = Blog::where('articleStatus',1)->paginate(20);
      return view('frontend.blog.index')->with(compact('title','blogList'));

    }elseif($menuId == 17){
      return view('frontend.contact.index')->with(compact('title'));
    }

    $metaTag =[
        'meta_keyword'=>$menu->metaKeyword,
        'meta_title' =>$menu->metaTitle,
        'meta_description' =>$menu->metaDescription
     ];
    return view('frontend.pages.page_content')->with(compact('metaTag','title','menu'));
    
  }

}
