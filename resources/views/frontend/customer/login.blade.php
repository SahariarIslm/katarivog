@extends('frontend.master')

@section('content')
    <div class="sign-in-page">
        <div class="row" style="padding-bottom: 20px;">
            <div class="col-md-6 col-sm-6">
                @php
                    $message = Session::get('message');
                      if (isset($message)) {
                        echo $message;
                      }
                    Session::forget('message');
                @endphp
            </div>
            <div class="col-md-6 col-sm-6">
                @php
                    $message = Session::get('msg');
                      if (isset($message)) {
                        echo $message;
                      }
                    Session::forget('msg');
                @endphp
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 sign-in">
                <h4 class="">Sign in</h4>
                <p class="">Hello, Welcome to your account.</p>
                {{-- <div class="social-sign-in outer-top-xs">
                    <a href="#" class="facebook-sign-in">
                        <i class="fa fa-facebook"></i> Sign In with Facebook
                    </a>
                    <a href="#" class="twitter-sign-in">
                        <i class="fa fa-twitter"></i> Sign In with Twitter
                    </a>
                </div> --}}
                <form class="register-form outer-top-xs" role="form" action="{{route('customer.dologin')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="setReview" value="{{@$setReview}}">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input name="custemail" type="email" value="{{old('custemail')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required="" />
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                        <input name="password" type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" required/>
                    </div>
                    <div class="radio outer-xs">
                        {{-- <label> 
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" />Remember me! 
                        </label> --}}
                        <a href="{{route('password.forget')}}" class="forgot-password pull-right">Forgot your Password?</a>
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                </form>
            </div>

            <div class="col-md-6 col-sm-6 create-new-account">
                <h4 class="checkout-subtitle">Create a new account</h4>
                <form class="register-form outer-top-xs" role="form" action="{{route('customer.register')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail2" required="" />
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required="" />
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
                        <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required="" />
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                        <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required="" />
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                        <input type="password" name="confirmPassword" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required="" />
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
@endsection

