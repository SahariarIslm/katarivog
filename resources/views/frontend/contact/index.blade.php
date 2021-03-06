@extends('frontend.master')

@section('content')
	<div class="contact-page">
    <div class="row">
        <div class="col-md-12 contact-map outer-bottom-vs">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.0080692193424!2d80.29172299999996!3d13.098675000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a526f446a1c3187%3A0x298011b0b0d14d47!2sTransvelo!5e0!3m2!1sen!2sin!4v1412844527190"
                width="600"
                height="450"
                style="border: 0;"
            ></iframe>
        </div>
        <div class="col-md-9 contact-form">
            <div class="col-md-12 contact-title">
                <h4>Contact Form</h4>
            </div>
            <div class="col-md-4">
                <form class="register-form" role="form" name="contactForm" method="post">
                	{{ csrf_field() }}
                    <div class="form-group">
                        <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input contactName" id="exampleInputName" placeholder="" />
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form class="register-form" role="form">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input contactEmail" id="exampleInputEmail1" placeholder="" required="" />
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form class="register-form" role="form">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input contactTitle" id="exampleInputTitle" placeholder="Title" />
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <form class="register-form" role="form">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputComments">Your Message <span>*</span></label>
                        <textarea class="form-control unicase-form-control contactMessage" id="exampleInputComments"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-md-12 outer-bottom-small m-t-20">
                <button type="submit" class="btn-upper btn btn-primary checkout-page-button contactFormButton">
	                Send Message
	            </button>
            </div>
        </div>
        <div class="col-md-3 contact-info">
            <div class="contact-title">
                <h4>Information</h4>
            </div>
            <div class="clearfix address">
                <span class="contact-i"><i class="fa fa-map-marker"></i></span>
                <span class="contact-span">
                	{{$information->siteAddress1}} <br>
                	{{$information->siteAddress2}} 
                </span>
            </div>
            <div class="clearfix phone-no">
                <span class="contact-i"><i class="fa fa-mobile"></i></span>
                <span class="contact-span">
                    {{$information->mobile1}}<br>
                    {{$information->mobile2}}
                </span>
            </div>
            <div class="clearfix email">
                <span class="contact-i"><i class="fa fa-envelope"></i></span>
                <span class="contact-span">
                	<a href="mailto:({{$information->siteEmail1}})" style="line-height: 18px;">{{$information->siteEmail1}}</a>
                    <a href="mailto:({{$information->siteEmail2}})" style="line-height: 18px;">{{$information->siteEmail2}}</a>
                </span>
            </div>
        </div>
    </div>
    <!-- /.contact-page -->
</div>


@endsection

