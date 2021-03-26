@extends('admin.layouts.master')

@section('content')
 <form class="form-horizontal" action="{{route('adminLogo.update')}}" method="POST" enctype="multipart/form-data" name="editlogos">
    {{ csrf_field() }}

    <input type="hidden" name="adminLogoId" value="{{$logos->id}}">

    <div class="row">
        <div class="col-md-6">
          <div class="form-group {{ $errors->has('adminTitle') ? ' has-danger' : '' }}">
               <label for="inputHorizontalDnger">Admin Panel Title</label>
                <input type="text" class="form-control" id="adminTitle" value="{{@$logos->adminTitle}}" name="adminTitle" required>
                
                @if ($errors->has('adminTitle'))
                    @foreach($errors->get('adminTitle') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>  
        </div>

        <div class="col-md-6">
          <div class="form-group {{ $errors->has('adminLogo') ? ' has-danger' : '' }}">
               <label for="inputHorizontalDnger" >Main Logo</label>
                <input type="file" class="form-control" id="adminLogo" aria-describedby="fileHelp" name="adminLogo">
                <span class="imageSizeInfo">
                    /* min width: 220px, min height:70px */
                </span><br>
                <img src="{{ asset('/').@$logos->adminLogo }}">
                <br>
                
                @if ($errors->has('adminLogo'))
                    @foreach($errors->get('adminLogo') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('adminsmalLogo') ? ' has-danger' : '' }}">
               <label for="inputHorizontalDnger">Small Logo</label>
                <input type="file" class="form-control" id="adminsmalLogo" aria-describedby="fileHelp" name="adminsmalLogo">
                <span class="imageSizeInfo">
                    /* min width: 70px, min height:65px */
                </span><br>
                <img src="{{ asset('/').@$logos->adminsmalLogo }}" style="width:75px;">
                @if ($errors->has('adminsmalLogo'))
                    @foreach($errors->get('adminsmalLogo') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div> 
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('adminfavIcon') ? ' has-danger' : '' }}">
               <label for="inputHorizontalDnger">Fav Icon</label>
                <input type="file" class="form-control" id="adminfavIcon" aria-describedby="fileHelp" name="adminfavIcon">
                <img src="{{ asset('/').@$logos->adminfavIcon }}" style="width:75px;">
                @if ($errors->has('adminfavIcon'))
                    @foreach($errors->get('adminfavIcon') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-12 m-b-20 text-right">    
        <button type="submit" class="btn btn-outline-info waves-effect">Update Information</button> 
    </div>              
</form>

@endsection
