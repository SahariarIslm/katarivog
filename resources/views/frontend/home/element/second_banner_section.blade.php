<div id="gap-257114766" class="gap-element clearfix 50px" style="display:block; height:auto;">
    <style scope="scope">
        #gap-257114766 {
          padding-top: 20px;
        }
    </style>
</div>
<div class="banner has-hover is-full-height" id="banner-1223622511">
    <div class="banner-inner fill" style="padding:0px 0px -10px 0px;margin:-100px 0px -100px 0px;">
        <div class="banner-bg fill" >
            <div class="bg fill bg-fill "></div>
        </div>
        <div class="banner-layers container">
            <div class="fill banner-link">
              @if($secondBanner)
                @foreach($secondBanner as $secondBanner)
                  <img width="1920" height="900" src="{{asset($secondBanner->image)}}" class="attachment-original size-original" alt="" loading="lazy"/>
                @endforeach
                @else
                  <img width="1920" height="900" src="{{$noImage}}" class="attachment-original size-original" alt="" loading="lazy"/>
                @endif
            </div>            
        </div>
    </div>
    <style scope="scope">
        #banner-1223622511 {
          padding-top: 280px;
          background-color: rgb(133, 143, 149);
        }
        #banner-1223622511 .bg.bg-loaded {
          background-image: url(wp-content/uploads/2021/02/Cover__2021__Web-1024x480.jpg);
        }


        @media (min-width:550px) {

          #banner-1223622511 {
            padding-top: 100%;
          }

        }
    </style>
</div>