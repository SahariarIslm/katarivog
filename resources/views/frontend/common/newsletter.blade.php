<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
  <h3 class="section-title">Newsletters</h3>
  <div class="sidebar-widget-body outer-top-xs">
    <p>Subscribe for Our Newsletter</p>
    <form name="newsletterForm" class="newsletterForm">
      <div class="form-group">
        <label class="sr-only" for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control subscriberEmail" id="exampleInputEmail1">
      </div>
      <button class="btn btn-primary subscribeButton">Subscribe</button>
    </form>
  </div> 
</div>

@section('custom_js')
  @include('frontend.include.others.newsletter_javascript')
@endsection

