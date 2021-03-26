<section class="section" id="section_1661744114">
    <div class="bg section-bg fill bg-fill  bg-loaded" >
        <div class="loading-spin centered"></div>
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width align-middle align-center"  id="row-2100694955">
            <div class="col small-12 large-12">
                <div class="col-inner" style="padding:0px 0px -10px 0px;margin:-100px 0px -100px 0px;" >
                    <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_1809445357">
                        <div class="img-inner dark" >
                            @if($firstBannerList)
                            @foreach($firstBannerList as $firstBanner)
                            <img width="1920" height="900" src="{{asset($firstBanner->image)}}" class="attachment-original size-original" alt="" loading="lazy"/> 
                            @endforeach
                            @else
                            <img width="1920" height="900" src="{{$noImage}}" class="attachment-original size-original" alt="" loading="lazy"/>
                            @endif
                        </div>
                        <style scope="scope">
                            #image_1809445357 {
                                width: 100%;
                            }
                            @media (min-width:550px) {
                                #image_1809445357 {
                                    width: 100%;
                                }
                            }
                        </style>
                    </div>
                </div>
            </div>
            <style scope="scope">
            </style>
        </div>
    </div>
    <style scope="scope">
        #section_1661744114 {
          padding-top: 200px;
          padding-bottom: 200px;
          margin-bottom: 0px;
          min-height: 0px;
          background-color: rgb(1, 103, 40);
        }
        @media (min-width:550px) {
          #section_1661744114 {
            padding-top: 100px;
            padding-bottom: 100px;
          }
        }
    </style>
</section>  