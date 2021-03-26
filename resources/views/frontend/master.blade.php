<!DOCTYPE html>
<html lang="en-US" class="loading-site no-js">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="UTF-8" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="xmlrpc.php" />
        <script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>
        <META NAME="KEYWORDS" CONTENT="<?php echo @$metaTag['meta_keyword']; ?>">
		<META property="og:title" NAME="TITLE" CONTENT="<?php echo @$metaTag['meta_title']; ?>">
		<META property="og:description" NAME="DESCRIPTION" CONTENT="<?php echo @$metaTag['meta_description']; ?>">
		<meta name="author" content="{{$information->siteName}}">
		<link rel="shortcut icon" type="image/png" href="{{ asset('/').@$information->sitefavIcon }}">
        <title>{{$information->siteName}} @if(@$title) {{@$information->titlePrefix}} @endif {{ @$title }}</title>
        @include('frontend.include.header.header-asset')
    </head>

	<body class="home page-template page-template-page-blank page-template-page-blank-php page page-id-12 theme-flatsome woocommerce-no-js full-width header-shadow box-shadow lightbox nav-dropdown-has-arrow">
		<a class="skip-link screen-reader-text" href="#main">Skip to content</a>
		<div id="wrapper">
			<header id="header" class="header has-sticky sticky-jump">
				@include('frontend.include.header.header')
			</header>
			<main id="main" class="">
				@yield('content')
			</main>
			<footer id="footer" class="footer color-bg">
				@include('frontend.include.footer.footer')
			</footer>
		</div>

		
		@include('frontend.include.footer.footer_asset')

		@include('frontend.include.others.shopping_cart_javascript')

		@include('frontend.category.category_product_javascript')
		
        @include('frontend.include.others.contact_javascript')

        @yield('custom_js')
	</body>

</html>

