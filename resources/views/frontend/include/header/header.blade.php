@php
  $customerId = Session::get('customerId');
@endphp
<div class="header-wrapper">
  <div id="top-bar" class="header-top hide-for-sticky nav-dark">
      <div class="flex-row container">
          <div class="flex-col hide-for-medium flex-left">
              <ul class="nav nav-left medium-nav-center nav-small  nav-divided">
                  <li class="html custom html_topbar_left">
                      <strong class="uppercase">
                          Organic Grocery Store || Opens Time: 9.00AM - 11.00PM
                      </strong>
                  </li>          
              </ul>
          </div>
          <div class="flex-col hide-for-medium flex-center">
              <ul class="nav nav-center nav-small  nav-divided">
              </ul>
          </div>
          <div class="flex-col hide-for-medium flex-right">
              <ul class="nav top-bar-nav nav-right nav-small  nav-divided">
                  <li class="header-contact-wrapper">
                      <ul id="header-contact" class="nav nav-divided nav-uppercase header-contact">
                          <li class="">
                              <a href="#" class="tooltip" title="katarivogbd@gmail.com">
                                  <i class="icon-envelop" style="font-size:13px;"></i>                 
                                  <span> e-mail </span>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="html custom html_topbar_right">
                      <strong class="uppercase">
                          +8801711-593755
                      </strong>
                  </li>
                  <li class="html header-social-icons ml-0">
                      <div class="social-icons follow-icons" >
                          <a href="https://www.facebook.com/Katarivog" target="_blank" data-label="Facebook"  rel="noopener noreferrer nofollow" class="icon plain facebook tooltip" title="Follow on Facebook">
                              <i class="icon-facebook" ></i>
                          </a>
                          <a href="https://www.instagram.com/katarivog" target="_blank" rel="noopener noreferrer nofollow" data-label="Instagram" class="icon plain  instagram tooltip" title="Follow on Instagram">
                              <i class="icon-instagram" ></i>
                          </a>
                      </div>
                  </li>          
              </ul>
          </div>
          <div class="flex-col show-for-medium flex-grow">
              <ul class="nav nav-center nav-small mobile-nav  nav-divided">
                  <li class="html custom html_topbar_left">
                      <strong class="uppercase">
                          Organic Grocery Store Opens Time: 9.00AM - 11.00PM
                      </strong>
                  </li>          
              </ul>
          </div>
      </div>
  </div>
  <div id="masthead" class="header-main nav-dark">
      <div class="header-inner flex-row container logo-left medium-logo-center" role="navigation">
      <!-- Logo -->
          <div id="logo" class="flex-col logo">
          <!-- Header logo -->
              <a href="{{route('home.index')}}" title="Katarivog - | Live Well |" rel="home">
                @if(file_exists(@$information->siteLogo))
                  <img width="142" height="75" src="{{asset($information->siteLogo)}}" alt="Katarivog"/>
                @else
                  <img width="142" height="75" src="{{asset($information->siteLogo)}}" alt="Katarivog"/>
                @endif
              </a>
          </div>
          <!-- Mobile Left Elements -->
          <div class="flex-col show-for-medium flex-left">
              <ul class="mobile-nav nav nav-left ">
                  <li class="nav-icon has-icon">
                      <a href="#" data-open="#main-menu" data-pos="left" data-bg="main-menu-overlay" data-color="" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">
                          <i class="icon-menu" ></i>
                      </a>
                  </li>   
              </ul>
          </div>
          <!-- Left Elements -->
          <div class="flex-col hide-for-medium flex-left
          flex-grow">
              <ul class="header-nav header-nav-main nav nav-left  nav-divided nav-size-large nav-uppercase">
                  
              </ul>
          </div>
          <!-- Right Elements -->
          <div class="flex-col hide-for-medium flex-right">
              <ul class="header-nav header-nav-main nav nav-right  nav-divided nav-size-large nav-uppercase">
                  <li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-12 current_page_item menu-item-21 active">
                      <a href="{{route('home.index')}}" aria-current="page" class="nav-top-link">
                          Home
                      </a>
                  </li>
                  <li id="menu-item-19" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19">
                      <a href="{{route('about_us')}}" class="nav-top-link">
                          About Us
                      </a>
                  </li>
                  <li id="menu-item-248" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-248 has-dropdown">

                      <a href="{{route('shop')}}" class="nav-top-link">
                          Shop
                          <i class="fa fa-chevron-down" style="font-size: 10px" aria-hidden="true"></i>
                      </a>

                      <ul class="sub-menu nav-dropdown nav-dropdown-default">
                        <?php 
                        use App\Category;
                        $category_list = Category::where('categoryStatus',1)->orderBy('orderBy','ASC')->get();
                        ?>
                        @foreach($category_list as $category)
                          <li id="menu-item-342" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-342">
                            <a href="{{ route('category.product',['id'=>$category->id,'name'=>str_replace(' ', '-', $category->categoryName)]) }}">{{$category->categoryName}}</a>
                          </li>
                        @endforeach
                      </ul>
                  </li>
                  <li id="menu-item-264" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-264">
                      <a href="" class="nav-top-link">
                          Nutrition Guide
                      </a>
                  </li>
                  <li id="menu-item-20" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20">
                      <a href="{{route('contact_us')}}" class="nav-top-link">
                          Contact
                      </a>
                  </li>
                  <li class="header-search header-search-lightbox has-icon">
                      <div class="header-button">     
                          <a href="#search-lightbox" aria-label="Search" data-open="#search-lightbox" data-focus="input.search-field"
                          class="icon primary button round is-small">
                          <i class="fa fa-search" style="font-size:16px;"></i>
                          </a>
                      </div>
                          
                      <div id="search-lightbox" class="mfp-hide dark text-center">
                          <div class="searchform-wrapper ux-search-box relative is-large">
                              <form role="search" method="get" class="searchform" action="https://katarivog.com.bd/">
                                  <div class="flex-row relative">
                                      <div class="flex-col search-form-categories">
                                          <select class="search_categories resize-select mb-0" name="product_cat">
                                              <option value="" selected='selected'>All</option>
                                              <option value="dairy">Dairy</option>
                                              <option value="grocery">Grocery</option>
                                              <option value="herbal">Herbal &amp; Grain</option>
                                              <option value="honey">Honey</option>
                                              <option value="meat-fish-dried-fish">Meat, Fish &amp; Dried Fish</option>
                                              <option value="nuts-fruits">Nuts &amp; Fruits</option>
                                              <option value="oil-edible-hair-skin">Oil - Edible, Hair &amp; Skin</option>
                                              <option value="homemade-pickle">Pickle &amp; Sauce</option>
                                              <option value="pitha-payesh-ingredients-seasonal-items">Pitha Payesh Ingredients &amp; Seasonal Items</option>
                                              <option value="spices">Spices</option>
                                          </select>           
                                      </div>
                                      <div class="flex-col flex-grow">
                                          <label class="screen-reader-text" for="woocommerce-product-search-field-0">
                                              Search for:
                                          </label>
                                          <input type="search" id="woocommerce-product-search-field-0" class="search-field mb-0" placeholder="Search" value="" name="s" />
                                          <input type="hidden" name="post_type" value="product" />
                                      </div>
                                      <div class="flex-col">
                                          <button type="submit" value="Search" class="ux-search-submit submit-button secondary button icon mb-0">
                                              <i class="icon-search" ></i>            
                                          </button>
                                      </div>
                                  </div>
                                  <div class="live-search-results text-left z-top"></div>
                              </form>
                          </div>  
                      </div>
                  </li>
                  <li class="account-item has-icon">
                      <div class="header-button">
                        @if(@$customerId)
                          <a href="{{ route('customer.logout') }}" class="nav-top-link nav-top-not-logged-in icon button circle is-outline is-small">
                              <span> Logout </span>
                          </a>
                        @else
                          <a href="#" class="nav-top-link nav-top-not-logged-in icon button circle is-outline is-small" data-open="#login-form-popup">
                              <span> Login </span>
                          </a>
                        @endif   
                      </div>
                  </li>
                  <li class="header-divider"></li>
                  <li class="cart-item has-icon has-dropdown" id="mini_cart">
                    @include('frontend.components.mini_cart')
                  </li>
              </ul>
          </div>
          <!-- Mobile Right Elements -->
          <div class="flex-col show-for-medium flex-right">
              <ul class="mobile-nav nav nav-right ">
                  <li class="cart-item has-icon">
                      <a href="" class="header-cart-link off-canvas-toggle nav-top-link is-small" data-open="#cart-popup" data-class="off-canvas-cart" title="Cart" data-pos="right">
                          <span class="cart-icon image-icon">
                              <strong>0</strong>
                          </span>
                      </a>
                      <!-- Cart Sidebar Popup -->
                      <div id="cart-popup" class="mfp-hide widget_shopping_cart">
                          <div class="cart-popup-inner inner-padding">
                              <div class="cart-popup-title text-center">
                                  <h4 class="uppercase">Cart</h4>
                                  <div class="is-divider"></div>
                              </div>
                              <div class="widget_shopping_cart_content">
                                  <p class="woocommerce-mini-cart__empty-message">
                                      No products in the cart.
                                  </p>
                              </div>
                              <div class="cart-sidebar-content relative"></div>  
                          </div>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
  </div>

  <div class="header-bg-container fill">
      <div class="header-bg-image fill"> 
      </div>
      <div class="header-bg-color fill">  
      </div>
  </div>   
</div>
<div id="login-form-popup" class="lightbox-content mfp-hide">
    <div style="clear:both; margin-bottom: 6px"></div>
    <div class="woocommerce-notices-wrapper"></div>
    <div class="account-container lightbox-inner">
      <div class="col2-set row row-divided row-large" id="customer_login">
        <div class="col-1 large-6 col pb-0"> 
          <div class="account-login-inner">
            <h3 class="uppercase">Login</h3>
            <form class="woocommerce-form woocommerce-form-login login" action="{{route('customer.dologin')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="setReview" value="{{@$setReview}}">
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="username">Username or email address&nbsp;<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="custemail" id="username" autocomplete="username" value="" />         
              </p>
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password">Password&nbsp;<span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
              </p>
              <p class="form-row">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                  <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>Remember me</span>
                </label>
                <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="f03a43b84a" />
                <input type="hidden" name="_wp_http_referer" value="/" />           
                <button type="submit" class="woocommerce-Button button woocommerce-form-login__submit" name="login" value="Log in">Log in</button> 
                
              </p>
              <p class="woocommerce-LostPassword lost_password">
                <a href="my-account/lost-password/index.html">Lost your password?</a>
              </p>
              <hr/>
              <p class="woocommerce-LostPassword lost_password">
                Login With Social Media
              </p>
              <p class="form-row">
                  <a href="https://www.katarivog.com.bd/customer/facebook/login" class="woocommerce-Button button"><i class="fa fa-facebook" style="margin: auto;" ></i></a>
              </p>
            </form>
          </div>
        </div>
        <div class="col-2 large-6 col pb-0">
          <div class="account-register-inner">
            <h3 class="uppercase">Register</h3>
            <form method="post" action="{{route('customer.register')}}" class="woocommerce-form woocommerce-form-register register"  >
              {{ csrf_field() }}
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_email">Email address&nbsp;<span class="required">*</span></label>
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="" />
              </p>
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_name">Name&nbsp;<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="name" id="reg_name" autocomplete="name" value="" />
              </p>
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_phone">Phone Number&nbsp;<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="mobile" id="reg_name" autocomplete="mobile" value="" />
              </p>
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_phone">Address&nbsp;<span class="required">*</span></label>
                
                <textarea name="address" rows="2" class="woocommerce-Input woocommerce-Input--text input-text"></textarea>
              </p>
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_password">Password&nbsp;<span class="required">*</span></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password"/>
              </p>
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_confirmPassword">Confirm Password&nbsp;<span class="required">*</span></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="confirmPassword" id="reg_confirmPassword" autocomplete="conform-password" />
              </p>
              <div class="woocommerce-privacy-policy-text">
                <p>
                  Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our 
                  <a href="privacy-policy/index.html" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>.
                </p>
              </div>
              <p class="woocommerce-FormRow form-row">
                <input type="hidden" id="woocommerce-register-nonce" name="woocommerce-register-nonce" value="2b4f2ed5c7" />
                <input type="hidden" name="_wp_http_referer" value="/" />           
                <button type="submit" class="woocommerce-Button button" name="register" value="Register">Register</button>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>