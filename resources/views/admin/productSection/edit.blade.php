@extends('admin.layouts.master')

@section('content')
    @php
        if(Auth::user()->parentRole != NULL){
            $disabled = 'disabled';
        }else{
         $disabled = '';   
        }

        $content_section_list = array('top_content' => 'Top Content','middle_content'=>'Middle content','bottom_content'=>'Bottom Content','side_content'=>"Sidebar Content" );
    @endphp
    <form class="form-horizontal" action="{{ route('productsection.edit',$product_section->id) }}" method="POST" enctype="multipart/form-data" name="form">
        {{ csrf_field() }}
        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
        </div>

        <div class="row">
           <div class="col-md-6">
               <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-danger" placeholder="product section name" name="name" value="{{ $product_section->name }}" required>
                    @if ($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
           </div>

           <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                       <div class="form-group {{ $errors->has('image_width') ? ' has-danger' : '' }}">
                            <label for="image_width">Width for Image</label>
                            <input type="number" class="form-control form-control-danger" placeholder="200" name="image_width" value="{{ $product_section->image_width }}" {{$disabled}}>
                            @if ($errors->has('image_width'))
                                @foreach($errors->get('image_width') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                   </div>

                   <div class="col-md-6">
                       <div class="form-group {{ $errors->has('image_height') ? ' has-danger' : '' }}">
                            <label for="image_height">Height for Image</label>
                            <input type="number" class="form-control form-control-danger" placeholder="200" name="image_height" value="{{ $product_section->image_height }}" {{$disabled}}>
                            @if ($errors->has('image_height'))
                                @foreach($errors->get('image_height') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                   </div>
                </div>
            </div>
       </div>
       
       <div class="row">
           <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('content_section') ? ' has-danger' : '' }}">
                            <label for="content_section">Content Section In Home Page</label>
                            <select class="form-control" name="content_section">
                                <option value="">Select Content Section</option>
                                @php
                                    foreach($content_section_list as $key=>$value){
                                        if($product_section->content_section == $key){
                                            $selected = "selected";
                                        }else{
                                           $selected = ""; 
                                        }
                                @endphp
                                    <option value="{{$key}}" {{@$selected }}>{{$value}}</option>
                                @php } @endphp
                            </select>
                            @if ($errors->has('content_section'))
                                @foreach($errors->get('content_section') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('order_by') ? ' has-danger' : '' }}">
                            <label for="order_by">Order By</label>
                            <input type="number" class="form-control form-control-danger" name="order_by" value="{{ $product_section->order_by }}" required>
                            @if ($errors->has('order_by'))
                                @foreach($errors->get('order_by') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
           </div>

           <div class="col-md-6">
                <label>Publication status</label>
                <div class="form-group {{ $errors->has('status') ? ' has-danger' : '' }}">
                    <div class="form-control">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="published" name="status" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="published">Published</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="unpublished" name="status" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="unpublished">Unpublished</label>
                        </div>
                    </div> 
                </div>
            </div>
       </div>

        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
        </div>              
    </form>

    <script type="text/javascript">
        document.forms['form'].elements['status'].value = "{{$product_section->status}}";
    </script>
@endsection


