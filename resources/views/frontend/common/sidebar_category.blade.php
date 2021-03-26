<div class="side-menu animate-dropdown">
	<div class="head"><i class="icon fa fa-bars"></i> Categories</div>
	<nav class="yamm megamenu-horizontal">
		<ul class="nav">
			@php
                foreach ($category_list_sidebar as $category_sidebar) {
                  $sub_category_list = \App\Helper\GetData::GetCategoryListForSidebar($category_sidebar->id);
                  
                  if($category_sidebar->icon){
                  	$categoryIcon = $category_sidebar->icon;
                  }else{
                  	$categoryIcon = "fa fa-shopping-bag";
                  }
              @endphp
				<li class="dropdown menu-item"> 
					<a 
						href="{{ route('category.product',['id'=>$category_sidebar->id,'name'=>str_replace(' ', '-', $category_sidebar->categoryName)]) }}"
						@if(count($sub_category_list) > 0)
							class="dropdown-toggle" 
							data-toggle="dropdown"
						@endif
					>
							<i class="icon @php echo $categoryIcon @endphp" aria-hidden="true"></i>
						{{$category_sidebar->categoryName}}
					</a>
					@if(count($sub_category_list) > 0)
						<ul class="dropdown-menu mega-menu">
							<li class="yamm-content">
								<div class="row">
									@php
		                              foreach ($sub_category_list as $sub_category) {
		                              	$child_category_list = \App\Helper\GetData::GetCategoryListForSidebar($sub_category->id);
		                            @endphp
										<div class="col-sm-12 col-md-3">
											<ul class="links list-unstyled">
												@php
				                                    foreach ($child_category_list as $child_category) {
			                                  	@endphp
													<li>
														<a href="{{ route('category.product',['id'=>$child_category->id,'name'=>str_replace(' ', '-', $child_category->categoryName)]) }}">{{$child_category->categoryName}}</a>
													</li>
												@php } @endphp
											</ul>
										</div>
									@php } @endphp
								</div>
							</li>
						</ul>
					@endif
				</li>
			@php } @endphp
		</ul>
	</nav>
</div>
