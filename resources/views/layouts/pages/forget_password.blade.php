@extends('layouts.app')

@section('content')
	<div class="login-box-body">
        <p class="login-box-msg">Reset password</p>    
        <form action="{{ route('admin.password.email') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                
                @if ($errors->has('email'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('email') }}</strong>
	                </span>
	            @endif

	            @php
					$message = Session::get('msg');
					if (isset($message)) {
						echo $message;
					}

					Session::forget('msg');
	            @endphp
            </div>
     
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Send password reset address</button>
                </div>
            </div>
        </form>
        <br>
        <a href="{{route('admin.login')}}" class="loginLink">Login</a><br>
    </div>
@endsection