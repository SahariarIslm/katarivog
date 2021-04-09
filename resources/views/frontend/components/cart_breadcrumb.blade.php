@if(Cart::count() > 0)
  <div class="focused-checkout-header pb">
      <div class="checkout-page-title page-title">
          <div class="page-title-inner flex-row medium-flex-wrap container">
            <div class="flex-col flex-grow medium-text-center">
              <nav class="breadcrumbs flex-row flex-row-center heading-font checkout-breadcrumbs text-center strong h4 none">
                <a href="{{route('cart.index')}}" class="{{\Route::currentRouteName() == 'cart.index' ?'current':''}}">
                  <span class="breadcrumb-step hide-for-small">1</span>Shopping Cart       
                </a>
                <span class="divider hide-for-small">
                  <i class="icon-angle-right"></i>
                </span>
                <a  href="{{route('cart.order')}}" class="hide-for-small {{\Route::currentRouteName() == 'cart.order' ?'current':''}}">
                  <span class="breadcrumb-step hide-for-small">2</span>Checkout details       
                </a>
              </nav>
            </div>
          </div>
      </div>
  </div>
@endif