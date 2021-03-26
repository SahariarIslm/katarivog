@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="{{ route('testimonial.edit',$testimonial->id) }}" method="POST" enctype="multipart/form-data" name="form">
        {{ csrf_field() }}
        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="first title" name="name" value="{{ @$testimonial->name }}">
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        {{-- <div class="form-group row {{ $errors->has('department') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Department</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="department" name="department" value="{{ @$testimonial->department }}">
                @if ($errors->has('department'))
                @foreach($errors->get('department') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div> --}}

        <div class="form-group row {{ $errors->has('institute') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Institute</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="Institute" name="institute" value="{{ @$testimonial->institute }}">
                @if ($errors->has('institute'))
                @foreach($errors->get('institute') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        {{-- <div class="form-group row {{ $errors->has('country') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Country</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="Country Name" name="country" value="{{ @$testimonial->country }}">
                @if ($errors->has('country'))
                @foreach($errors->get('country') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('title') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-danger" placeholder="title" name="title" value="{{ @$testimonial->title }}">
                @if ($errors->has('title'))
                @foreach($errors->get('title') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div> --}}

        <div class="form-group row {{ $errors->has('image') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control form-control-danger" name="image" value="{{ old('image') }}">
                <span class="imageSizeInfo">/* Standard Image Size : 270*270 */ <br></span>
                <?php if (file_exists(@$testimonial->image)) { ?> 
                <img src="{{asset('/').@$testimonial->image}}" style="height: 90px;">
                <?php }else{ ?>
                    <img src="{{$noImage}}" style="height: 94px;">
                <?php } ?>
                @if ($errors->has('image'))
                @foreach($errors->get('image') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
                
            </div>
        </div>

        <div class="form-group row {{ $errors->has('description') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9">
                <textarea class="form-control tinymce" name="description" style="min-height: 250px"><?php echo $testimonial->description; ?></textarea>
                @if ($errors->has('description'))
                @foreach($errors->get('description') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

         <div class="form-group row {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Order By</label>
            <div class="col-sm-9">
                <input type="number"   name="orderBy" value="{{ $testimonial->orderBy }}" required>
                @if ($errors->has('orderBy'))
                @foreach($errors->get('orderBy') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>
        
        <div class="form-group row {{ $errors->has('status') ? ' has-danger' : '' }}">
            <label class="col-sm-3 col-form-label">Publication status</label>
            <div class="col-sm-9 row">
                <div class="form-control">
                    <div>
                        <input type="radio" name="status" value="1" required>
                        <label for="published">Published</label>
                    </div>
                    <div>
                        <input type="radio" name="status" checked="" value="0">
                        <label for="unpublished">Unpublished</label>
                    </div>
                </div>                            
            </div>
        </div>

        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
        </div>              
    </form>
<script type="text/javascript">
        document.forms['form'].elements['status'].value = "{{$testimonial->status}}";
</script>

@endsection


