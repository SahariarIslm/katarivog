@php
  use App\Testimonial;
  $testimonialList = Testimonial::where('status',1)->orderBy('orderBy','ASC')->get();
@endphp
@if(count($testimonialList) > 0)
  <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
    <div id="advertisement" class="advertisement">
      @foreach ($testimonialList as $testimonial)
        <div class="item">
          <div class="avatar">
            @if(file_exists($testimonial->image))
              <img src="{{ asset($testimonial->image) }}" alt="Image">
            @else
              <img src="{{ $noImage }}" alt="Image">
            @endif
          </div>
          <div class="testimonials">
            @php
              echo str_limit($testimonial->description,300);
            @endphp
          </div>
          <div class="clients_author">{{ $testimonial->name}} <span>{{$testimonial->institute}}</span> </div>
        </div>
      @endforeach

    </div>
  </div>
@endif