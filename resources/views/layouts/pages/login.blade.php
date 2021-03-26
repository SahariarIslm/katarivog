@extends('layouts.app')

@section('content')
	<div class="login-box-body">
		<p class="login-box-msg">ADMINISTRATION</p>
		<form action="{{ route('admin.login') }}" method="post">
			{{ csrf_field() }}
			<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
				<input type="email" name="email" class="form-control" placeholder="Email address"  value="{{ old('email') }}" required autofocus>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				@if ($errors->has('email'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('email') }}</strong>
	                </span>
	            @endif

	            @if(Session::get('msg'))
		            <span class="help-block">
			            <strong>
			            	@php
			            		echo Session::get('msg');
								Session::forget('msg');
			            	@endphp
			            </strong>
			        </span>
	            @endif
			</div>

			@php
				if($errors->has('password') || Session::get('passwordMessage')){
					$errorClass = "has-error";
				}else{
					$errorClass = "";
				}
			@endphp

			<div class="form-group has-feedback {{ $errorClass }}">
				<input type="password" name="password" class="form-control" placeholder="Password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				@if ($errors->has('password'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('password') }}</strong>
	                </span>
	            @endif

	            @if(Session::get('passwordMessage'))
		            <span class="help-block">
			            <strong>
			            	@php
			            		echo Session::get('passwordMessage');
								Session::forget('passwordMessage');
			            	@endphp
			            </strong>
			        </span>
	            @endif
			</div>
			<div class="row">
				<div class="col-xs-7">
					<div class="checkbox icheck">
						{{-- <label>
							<input type="checkbox" name="remember"> Remember me
						</label> --}}
					</div>
				</div>
				<div class="col-xs-5">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
				</div>
			</div>
		</form>
		<a href="{{ route('admin.password.forget') }}" class="forgetPasswordLink">Forgot your password?</a><br>
	</div>
@endsection