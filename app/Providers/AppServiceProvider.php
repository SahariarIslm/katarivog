<?php

namespace App\Providers;
use DB;
use View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Settings;
use App\Category;
use App\SocialLink;
use App\UserMenu;
use App\UserMenuActions;
use App\Menu;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        //Link Frontend information
        View::composer('*',function($siteInfo){
            $information = Settings::where('id',1)->first();
            $siteInfo->with('information',$information);
        });

        //Link for No Image
        View::composer('*',function($blankImage){
            $blank = asset('/public/admin-elite/no-image-icon.png');
            $blankImage->with('noImage',$blank);
        });

        //Link for Go Back
        View::composer('*',function($backLink){
            $routeName = \Request::route()->getName();
            $userMenuAction = UserMenuActions::where('actionLink',@$routeName)->first();
            $userMenu = UserMenu::where('id',@$userMenuAction->parentmenuId)->first();
            $backLink->with('goBackLink',@$userMenu->menuLink);
        });

        //Link for Category list in frontend menu
        View::composer('*',function($categories){
            $category_list_menu = Category::where('parent',NULL)->where('showInMainMenu',1)->where('categoryStatus',1)->orderBy('orderBy','ASC')->orderBy('categoryName','ASC')->get();
            $categories->with('category_list_menu',$category_list_menu);
        });

        //Link for Category list in frontend Sidebar
        View::composer('*',function($categories){
            $category_list_sidebar = Category::where('parent',NULL)->where('showInSidebarCategory',1)->where('categoryStatus',1)->orderBy('orderBy','ASC')->orderBy('categoryName','ASC')->get();
            $categories->with('category_list_sidebar',$category_list_sidebar);
        });

        //Link For Social Info
        View::composer('*',function($socialInfo){
            $socialLink = SocialLink::where('status',1)->get();
            $socialInfo->with('socialLink',$socialLink);
        });

    }

}
