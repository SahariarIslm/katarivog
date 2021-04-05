<div class="col large-3 hide-for-medium ">
		<div id="shop-sidebar" class="sidebar-inner col-inner">
			<aside id="woocommerce_price_filter-4" class="widget woocommerce widget_price_filter">
				<span class="widget-title shop-sidebar">Filter by price</span>
				<div class="is-divider small"></div>
				<form method="get" action="https://milkybd.com/shop/">
					<div class="price_slider_wrapper">
						<div class="price_slider" style="display:none;"></div>
						<div class="price_slider_amount" data-step="10">
							<input type="text" id="min_price" name="min_price" value="40" data-min="40" placeholder="Min price" />
							<input type="text" id="max_price" name="max_price" value="1790" data-max="1790" placeholder="Max price" />
							<button type="submit" class="button">Filter</button>
							<div class="price_label" style="display:none;">
								Price: <span class="from"></span> &mdash; <span class="to"></span>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</form>
			</aside>
			<aside id="woocommerce_product_categories-4" class="widget woocommerce widget_product_categories">
				<span class="widget-title shop-sidebar">Product categories</span>
				<div class="is-divider small"></div>
				<ul class="product-categories">
					@if(!empty($category_list))
						@foreach($category_list as $category)
							<li class="cat-item cat-item-18">
								<a href="{{ route('category.product',['id'=>$category->id,'name'=>str_replace(' ', '-', $category->categoryName)]) }}">{{$category->categoryName}}</a>
							</li>
						@endforeach
					@else
					<li class="cat-item cat-item-18">
						<a href="#">No Categories Available</a>
					</li>
					@endif
				</ul>
			</aside>			
		</div>
	</div>