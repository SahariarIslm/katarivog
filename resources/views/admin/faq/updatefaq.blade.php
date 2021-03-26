@extends('admin.layouts.master')


@section('content')
<form class="form-horizontal" action="{{ route('faq.update') }}" method="POST" enctype="multipart/form-data" id="editfaq" name="editfaq">
    {{ csrf_field() }}
    <input type="hidden" name="faqId" value="{{$faq->id}}">
    <div class="col-md-12 m-b-20 text-right">    
    <button type="submit" class="btn btn-info waves-effect">Save</button> 
    </div>
    <br>
    <div class="form-group row {{ $errors->has('title') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Question</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-danger" placeholder="write your question" name="title" value="{{ $faq->title }}" required>
            @if ($errors->has('title'))
            @foreach($errors->get('title') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>
    
    <div class="form-group row {{ $errors->has('description') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Answer</label>
        <div class="col-sm-10">
            <textarea class=" form-control form-control-danger" name="description" value="{{ old('description') }}" style="min-height: 400px;" required>{{ $faq->description }}</textarea>
            @if ($errors->has('description'))
            @foreach($errors->get('description') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('metaTitle') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Meta Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-danger" placeholder="Meta Title" name="metaTitle" value="{{ $faq->metaTitle }}">
            @if ($errors->has('metaTitle'))
            @foreach($errors->get('metaTitle') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('metaKeyword') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Meta keyword</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-danger" placeholder="Meta Keyword" name="metaKeyword" value="{{ $faq->metaKeyword }}">
            @if ($errors->has('metaKeyword'))
            @foreach($errors->get('metaKeyword') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('metaDescription') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Meta description</label>
        <div class="col-sm-10">
            <textarea style="min-height: 100px;" class="form-control" name="metaDescription">{{ $faq->metaDescription }}</textarea>
            @if ($errors->has('metaDescription'))
            @foreach($errors->get('metaDescription') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

     <div class="form-group row {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Order By</label>
        <div class="col-sm-10">
            <input type="number"   name="orderBy" value="{{ $faq->orderBy }}" required>
            @if ($errors->has('orderBy'))
            @foreach($errors->get('orderBy') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('status') ? ' has-danger' : '' }}">
        <label class="col-sm-2 col-form-label">Publication status</label>
        <div class="col-sm-10 row">
            <div class="form-control">
                <div class="custom-control custom-radio">
                    <input type="radio" id="published" name="status" class="custom-control-input" value="1" required>
                    <label class="custom-control-label" for="published">Published</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="unpublished" name="status" class="custom-control-input" checked="" value="0">
                    <label class="custom-control-label" for="unpublished">Unpublished</label>
                </div>
            </div>                            
        </div>
    </div>                
</form>
@endsection

@section('custom-js')

     <script type="text/javascript">
        document.forms['editfaq'].elements['status'].value = "{{$faq->status}}";

        
    </script>

@endsection