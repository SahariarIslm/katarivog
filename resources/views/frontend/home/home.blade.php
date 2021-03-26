@extends('frontend.master')  

@section('content')
    <div id="content" role="main" class="content-area">
        @include('frontend.home.element.first_banner_section')
        @include('frontend.home.element.category')
        @include('frontend.home.element.second_banner_section')
        <div id="gap-1333918693" class="gap-element clearfix 50px" style="display:block; height:auto;">
            <style scope="scope">
                #gap-1333918693 {
                  padding-top: 0px;
                }
            </style>
        </div>
        <section class="section" id="section_49944650">
            <div class="bg section-bg fill bg-fill  bg-loaded" ></div>
            <div class="section-content relative">

                @include('frontend.home.element.our_services')
                @include('frontend.home.element.featured_products')
                @include('frontend.home.element.health_and_benifits')
            </div>
            <style scope="scope">
                #section_49944650 {
                  padding-top: 20px;
                  padding-bottom: 20px;
                  margin-bottom: 0px;
                  min-height: 0px;
                }
            </style>
        </section>
        @include('frontend.home.element.newsletter')
    </div>      
@endsection