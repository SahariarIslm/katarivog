<!DOCTYPE html>
<html lang="bn">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {{ $information->siteName }} @if(@$title) {{@$information->titlePrefix}} @endif {{ @$title }}
    </title>
     <meta name="csrf-token" content="{{ csrf_token() }}">
        
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('/public/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/public/')}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('/public/')}}/css/ionicons.min.css">
    
    <link rel="stylesheet" href="{{asset('/public/')}}/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{asset('/public/')}}/css/all-skins.min.css">
    
    <link rel="stylesheet" href="{{asset('/public/')}}/css/pnotify.custom.min.css">
    
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/public/')}}/css/blue.css">
    
    <!-- Admin Global CSS -->
    <link rel="stylesheet" href="{{asset('/public/')}}/css/style.css">

</head>
<body class="hold-transition skin-green login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/')}}">
                <img src="{{ asset('/').@$information->adminLogo }}" style="width:200px; height:auto;">
            </a>
        </div>
        @yield('content')
    </div>

    <!-- jQuery 2.2.3 -->
    <script src="{{asset('/public/')}}/js/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{asset('/public/')}}/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="{{asset('/public/')}}/js/icheck.min.js"></script>

    <script src="{{asset('/public/')}}/js/app.min.js"></script>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>

    <script src="{{asset('/public/')}}/js/pnotify.custom.min.js"></script>
    <script type="text/javascript">
    	jQuery(document).ready(function ($) {
    		
    	PNotify.prototype.options.styling = "bootstrap3";
    	PNotify.prototype.options.styling = "fontawesome";
    	
    		});
    </script>

</body>

</html>
