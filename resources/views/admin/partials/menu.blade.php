@php
    use App\UserMenu;
    use App\UserRoles;
    $userMenus = UserMenu::where('menuStatus',1)->orderBy('orderBy','ASC')->get();
    $roleId =  Auth::user()->role;
    $userRoles = UserRoles::where('id',$roleId)->first();
    use App\UserMenuActions;
    $routeName = \Request::route()->getName();
    $userMenuAction = UserMenuActions::where('actionLink',$routeName)->first();
    if(@$userMenuAction){
        $childMenuRoute = UserMenu::where('id',@$userMenuAction->parentmenuId)->first();
        $parentMenuRoute = UserMenu::where('id',@$childMenuRoute->parentMenu)->first();
        $rootMenuRoute = UserMenu::where('id',@$parentMenuRoute->parentMenu)->first();
    }else{
        $childMenuRoute = UserMenu::where('menuLink',@$routeName)->first();
        $parentMenuRoute = UserMenu::where('id',@$childMenuRoute->parentMenu)->first();
        $rootMenuRoute = UserMenu::where('id',@$parentMenuRoute->parentMenu)->first();
    }
@endphp
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" style="height: 97%">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav"> 
        @php
            foreach ($userMenus as $menu) {
            $rolePermission = explode(',', $userRoles->permission);
            if (in_array($menu->id, $rolePermission)) {
                if ($menu->parentMenu == null) {
                $parentMenuLink = $menu->menuLink;
                $childMenu = UserMenu::orderBy('orderBy','ASC')->where('parentMenu',$menu->id)->where('menuStatus',1)->get();
                $countChildMenu = count(@$childMenu);
                if (@$parentMenuRoute->id == $menu->id || @$rootMenuRoute->id == $menu->id) {
                    $parentMenuActive = 'active';
                    $expandParent = 'in';
                }else{
                     
                  $parentMenuActive = '';
                  $expandParent = '';
                }
        @endphp
            <li class="{{$parentMenuActive}}"> 
                @if ($countChildMenu > 0 )
                    <a class="waves-effect waves-dark has-arrow {{$parentMenuActive}}" href="javascript:void(0)"><i class="fa fa-bars"></i><span class="hide-menu">{{$menu->menuName}} </span></a>
                @else
                    <a class="waves-effect waves-dark" href="{{ route($parentMenuLink) }}"><i class="fa fa-bars"></i><span class="hide-menu">{{$menu->menuName}} </span></a>
                @endif

                @if ($countChildMenu > 0)
                    <ul aria-expanded="false" class="collapse {{$expandParent}}">
                        @php
                            foreach ($childMenu as $menuChild) {
                                $rolePermission = explode(',', $userRoles->permission);
                                if (in_array($menuChild->id, $rolePermission)) {
                                $childMenuLink = $menuChild->menuLink;

                                 if (@$childMenuRoute->menuLink == $menuChild->menuLink) {
                                   $activeChildMenu = 'active';
                                   $expandSubMenuParent = 'in';
                                }else{
                                     $activeChildMenu = '';
                                     $expandSubMenuParent = '';
                                }

                                $secondChildMenuList = UserMenu::orderBy('orderBy','ASC')->where('parentMenu',$menuChild->id)->where('menuStatus',1)->get();
                        @endphp

                         <li class="{{$activeChildMenu}}">
                            @if (count($secondChildMenuList) > 0 )
                               <a href="javascript:void(0)" class="{{$activeChildMenu}}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{$menuChild->menuName}}
                                </a>
                            @else
                                <a href="{{ route($childMenuLink) }}" class="{{$activeChildMenu}}">
                                    <i class="fa fa-caret-right"></i>
                                   {{$menuChild->menuName}}
                                </a>
                            @endif

                            <ul aria-expanded="false" class="collapse {{$expandSubMenuParent}}">
                                @php
                                    foreach ($secondChildMenuList as $secondChildMenu) {
                                        $rolePermission = explode(',', $userRoles->permission);
                                        if (in_array($secondChildMenu->id, $rolePermission)) {
                                        $childMenuLink = $secondChildMenu->menuLink;

                                         if (@$childMenuRoute->menuLink == $secondChildMenu->menuLink) {
                                           $activeChildMenu = 'active';
                                        }else{
                                             $activeChildMenu = '';
                                        }
                                @endphp
                                 <li class="{{$activeChildMenu}}">
                                    <a href="{{ route($childMenuLink) }}" class="{{$activeChildMenu}}">
                                        <i class="fa fa-caret-right"></i>
                                       {{$secondChildMenu->menuName}}
                                    </a>
                                </li>
                            @php
                                } }
                            @endphp
                            </ul>
                        </li>
                    @php
                        } }
                    @endphp
                    </ul>
                @endif
            </li>
        @php
            } } }
        @endphp

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>