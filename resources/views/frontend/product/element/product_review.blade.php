@php
    $setReview = @$_GET['setReview'];
    if (@$setReview == $product->id) {
      $activeReview = 'active';
      $activeTab = 'active in';
    }else{
      $activeReview = '';
    }

    if(!@$setReview){
      $active = 'active';
    }
@endphp
    
    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
        <div class="row">
            <div class="col-sm-3">
                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                    <li class="{{@$active}}">
                        <a data-toggle="tab" href="#description">DESCRIPTION</a>
                    </li>
                    <li class="{{$activeReview}}">
                        <a data-toggle="tab" href="#review">REVIEW</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tags">TAGS</a>
                    </li>
                </ul><!-- /.nav-tabs #product-tabs
                 -->
            </div>
            <div class="col-sm-9">

                <div class="tab-content">

                    <div id="description" class="tab-pane in active">
                        <div class="product-tab">
                            @php
                                echo $product->description2;
                            @endphp
                        </div>  
                    </div><!-- /.tab-pane -->

                    <div id="review" class="tab-pane {{@$activeTab}}">
                        <div class="product-tab">

                            <div class="product-reviews">
                                <h4 class="title">Customer Reviews</h4>
                                @php
                                    foreach($reviews as $review) {
                                    $reviewDate = date('d-m-Y',strtotime($review->created_at));
                                    @$revewRating = 1*100/$review->star;

                                    $to = \Carbon\Carbon::createFromFormat('d-m-Y', $reviewDate);
                                    $from = \Carbon\Carbon::createFromFormat('d-m-Y', date('d-m-Y'));
                                    $days = $to->diffInDays($from);
                                @endphp
                                    <div class="reviews">
                                        <div class="review">
                                            <div class="review-title">
                                                <span class="summary">{{@$review->summary}}</span>
                                                <span class="date"><i class="fa fa-calendar"></i><span>
                                                {{$days}} days ago</span></span>
                                            </div>
                                            <div class="text">{{$review->review}}</div>
                                        </div>
                                    </div>
                                @php } @endphp
                            </div>

                            @if(!Session::get('customerId'))
                                <p style="color: red;">/*Please 
                                    <a style="font-size: 15px;color: #0f7a9a;" href="{{route('customer.login',['setReview'=>@$product->id])}}">Login
                                    </a> 
                                    First and complete your review*\
                                </p>
                            @else
                                <form action="{{route('customerReview.save')}}"  method="post" role="form" class="cnt-form">
                                    <div class="product-add-review">
                                        <h4 class="title">Write your own review</h4>
                                        <div class="review-table">
                                            <div class="table-responsive">
                                                <table class="table">   
                                                    <thead>
                                                        <tr>
                                                            <th class="cell-label">&nbsp;</th>
                                                            <th>1 star</th>
                                                            <th>2 stars</th>
                                                            <th>3 stars</th>
                                                            <th>4 stars</th>
                                                            <th>5 stars</th>
                                                        </tr>
                                                    </thead>    
                                                    <tbody>
                                                        <tr>
                                                            <td class="cell-label">Rating</td>
                                                            <td><input type="radio" name="star" class="radio" value="1"></td>
                                                            <td><input type="radio" name="star" class="radio" value="2"></td>
                                                            <td><input type="radio" name="star" class="radio" value="3"></td>
                                                            <td><input type="radio" name="star" class="radio" value="4"></td>
                                                            <td><input type="radio" name="star" class="radio" value="5" required=""></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="review-form">
                                            <div class="form-container">
                                                    {{ csrf_field() }}
                                                      <input type="hidden" name="productId" value="{{$product->id}}">
                                                      <input type="hidden" name="productName" value="{{$product->name}}">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputName">Your Name 
                                                                    <span class="astk">*</span>
                                                                </label>
                                                                <input type="text" name="name" class="form-control txt" id="exampleInputName" required>
                                                            </div><!-- /.form-group -->
                                                            <div class="form-group">
                                                                <label for="exampleInputSummary">Summary 
                                                                    <span class="astk">*</span>
                                                                </label>
                                                                <input type="text" name="summary" class="form-control txt" id="exampleInputSummary" required>
                                                            </div><!-- /.form-group -->
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputReview">Review 
                                                                    <span class="astk">*</span>
                                                                </label>
                                                                <textarea class="form-control txt txt-review" name="review" id="exampleInputReview" rows="4" required=""></textarea>
                                                            </div><!-- /.form-group -->
                                                        </div>
                                                    </div><!-- /.row -->

                                                    <div class="action text-right">
                                                        <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif                                 

                        </div><!-- /.product-tab -->
                    </div><!-- /.tab-pane -->

                    <div id="tags" class="tab-pane">
                        <div class="product-tag">

                            <h4 class="title">Product Tags</h4>
                            <form role="form" class="form-inline form-cnt">
                                <div class="form-container">

                                    <div class="form-group">
                                        <label for="exampleInputTag">Add Your Tags: </label>
                                        <input type="email" id="exampleInputTag" class="form-control txt">


                                    </div>

                                    <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                                </div><!-- /.form-container -->
                            </form><!-- /.form-cnt -->

                            <form role="form" class="form-inline form-cnt">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                                </div>
                            </form><!-- /.form-cnt -->

                        </div><!-- /.product-tab -->
                    </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>