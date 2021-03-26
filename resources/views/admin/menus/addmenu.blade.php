@extends('admin.layouts.master')

@section('content')

<form class="form-horizontal" action="{{ route('menuadd.page') }}" method="POST" enctype="multipart/form-data" id="newMenu" name="newMenu">
    {{ csrf_field() }}
    
    <div class="form-group row {{ $errors->has('parent') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Select Parent</label>
        <div class="col-sm-9">
            <select class="form-control chosen-select" name="parent">
                <option value=" ">Select Parent</option>
        <?php
            foreach ($menus as $menu) {
        ?>
                <option value="{{$menu->id}}">{{$menu->menuName}}</option>
        <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row {{ $errors->has('menuName') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Menu Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger" placeholder="Menu name" name="menuName" value="{{ old('menuName') }}" required>
            @if ($errors->has('menuName'))
            @foreach($errors->get('menuName') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('articleName') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Header Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger" placeholder="header name" name="articleName" value="{{ old('articleName') }}" required="">
            @if ($errors->has('articleName'))
            @foreach($errors->get('articleName') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('firstHomeTitle') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger" placeholder="home page title" name="firstHomeTitle" value="{{ old('firstHomeTitle') }}">
            @if ($errors->has('firstHomeTitle'))
            @foreach($errors->get('firstHomeTitle') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('firstHomeImage') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Header Image</label>
        <div class="col-sm-9">
            <input type="file" class="form-control form-control-danger" name="firstHomeImage">
            <span class="imageSizeInfo">/* Standard Image Size : 2000*585 px */ <br></span>
            @if ($errors->has('firstHomeImage'))
            @foreach($errors->get('firstHomeImage') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('homeDescription') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Home Description</label>
        <div class="col-sm-9">
            <textarea class="form-control tinymce" name="homeDescription" style="min-height: 250px"></textarea>
            @if ($errors->has('homeDescription'))
            @foreach($errors->get('homeDescription') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('urlLink') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Url Link</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger" placeholder="write menu link of home page" name="urlLink" value="{{ old('urlLink') }}">
            @if ($errors->has('urlLink'))
            @foreach($errors->get('urlLink') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('menuIcon') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Icon</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger" placeholder='<i class="fa fa-icon"></i>' name="menuIcon" value="{{ old('menuIcon') }}">
            @if ($errors->has('menuIcon'))
            @foreach($errors->get('menuIcon') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('metaTitle') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta Title</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger" placeholder="Meta Title" name="metaTitle" value="{{ old('metaTitle') }}">
            @if ($errors->has('metaTitle'))
            @foreach($errors->get('metaTitle') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('metaKeyword') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta keyword</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger" placeholder="Meta Keyword" name="metaKeyword" value="{{ old('metaKeyword') }}" data-role="tagsinput">
            @if ($errors->has('metaKeyword'))
            @foreach($errors->get('metaKeyword') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('metaDescription') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta description</label>
        <div class="col-sm-9">
            <textarea style="min-height: 100px;" class="form-control" name="metaDescription">{{ old('metaDescription') }}</textarea>
            @if ($errors->has('metaDescription'))
            @foreach($errors->get('metaDescription') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

     <div class="form-group row {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Order By</label>
        <div class="col-sm-9">
            <input type="number"   name="orderBy" value="{{ old('orderBy') }}" required>
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
                <div class="custom-control custom-radio">
                    <input type="radio" id="published" name="menuStatus" class="custom-control-input" value="1"  checked="" required>
                    <label class="custom-control-label" for="published">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="unpublished" name="menuStatus" class="custom-control-input" value="0">
                    <label class="custom-control-label" for="unpublished">No</label>
                </div>
            </div>                          
        </div>
    </div>

    <div class="form-group row {{ $errors->has('showInMenu') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Visible in Main Menu</label>
        <div class="col-sm-9">
            <div class="form-control">
                <div class="custom-control custom-radio">
                    <input type="radio" id="showInMenu" name="showInMenu" class="custom-control-input" value="1" required>
                    <label class="custom-control-label" for="showInMenu">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="hideInMainMenu" name="showInMenu" class="custom-control-input" value="0" checked="">
                    <label class="custom-control-label" for="hideInMainMenu">No</label>
                </div>
            </div> 
        </div>
    </div>

    <div class="form-group row {{ $errors->has('showInFooterMenu') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Visible in Footer Menu</label>
        <div class="col-sm-9">
            <div class="form-control">
                <div class="custom-control custom-radio">
                    <input type="radio" id="showInFooterMenu" name="showInFooterMenu" class="custom-control-input" value="1" required>
                    <label class="custom-control-label" for="showInFooterMenu">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="hideInFooterMainMenu" name="showInFooterMenu" class="custom-control-input" value="0" checked="">
                    <label class="custom-control-label" for="hideInFooterMainMenu">No</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 m-b-20 text-right">    
        <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> SAVE</button> 
    </div>              
</form>

@endsection
