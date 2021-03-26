@extends('admin.layouts.master')

@section('content')

<form class="form-horizontal" action="{{ route('flashSell.update') }}" method="POST" enctype="multipart/form-data" name="advanceInfo">
    {{ csrf_field() }}

    <div class="modal-body">
         <div class="row">
            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> SAVE</button> 
            </div>
        </div> 

         <div class="form-group row {{ $errors->has('special') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Flash Sell</label>
            <div class="col-sm-10">
                {{--  <input type="text" placeholder="Price for for flash sell" name="flashPrice" value="{{  @$flashProducts->flashPrice }}"> --}}

                 <input type="text" class="datepicker" placeholder="Date" name="flashDate" value="{{ @$flashProducts->flashDate }}">
            </div>

        </div>
        <?php
            @$flashProduct = explode(',', $flashProducts->flashProduct);
        ?>

        <div class="form-group row">
            <label for="inputHorizontalDnger" class="col-sm-2 col-form-label"> Add Product</label>
            <div class="col-sm-10">
            <select name="flashProduct[]" data-placeholder="Select Products" class="form-control chosen-select" multiple tabindex="4">
               
                @foreach($productsAll as $products)
                        <option <?php if (in_array($products->id, $flashProduct)){echo "selected";} ?> value="{{ $products->id }}">{{ $products->name }}({{ $products->deal_code }})</option>
                 @endforeach
               
  
            </select>
                @if ($errors->has('related_product'))
                @foreach($errors->get('related_product') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>
        </div>            
    </form>
@endsection



