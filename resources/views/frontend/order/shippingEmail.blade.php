@extends('frontend.master')

@section('content')
    <div class="sign-in-page">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-7 col-sm-offset-4 col-xs-12 col-xs-offset-4  sign-in center-block">
                <?php
                    $message = Session::get('message');
                      if (isset($message)) {
                        echo $message;
                      }
                      Session::forget('message');
                ?>        
                
                <form class="register-form outer-top-xs" role="form" action="{{url('/view-order')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <h3 class="info-title" for="exampleInputEmail1">Email Address / Phone No <span>*</span></h3>
                        <input name="custemail" type="text" value="{{old('custemail')}}" class="form-control unicase-form-control text-input" id="custemail" required="" />
                    </div>
                    
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">GO</button>
                </form>
            </div>
        </div>
    </div>
@endsection

