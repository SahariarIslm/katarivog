@extends('layouts.app')

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Give Your New Password</p>
        <form action="{{ route('admin.password.save') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="email" value="{{$users->email}}">
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
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
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="confirm password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-7">
                   
                </div>
                <div class="col-xs-5">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
@endsection