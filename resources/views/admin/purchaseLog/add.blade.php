@extends('admin.layouts.master')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<?php
    use App\PurchaseReturn;
    $purchae_return = PurchaseReturn::whereRaw('id = (select max(`id`) from purchase_returns)')->first();
    if(!$purchae_return){
        $purchase_return_serial = 1000000+1;
    }else{
        $purchase_return_serial = 1000000+$purchae_return->id+1;
    }
?>

<div class="row">
    <div class="col-12">
        <div class="card" style="margin-bottom: 200px;">
    <span class="shortlink">
         <a class="btn btn-info"  href="{{ route($goBackLink) }}">Go Back</a>
    </span>
            <div class="card-body">
                <?php
                    $message = Session::get('msg');
                      if (isset($message)) {
                        echo"<div style='display:inline-block;width: auto;' class='alert alert-success'><strong>" .$message."</strong></div>";
                      }

                      Session::forget('msg')
                ?>
                 <h4 class="card-title">{{$title}}</h4>

                  <div id="addNewMenu" class="">
    <div class="">        
        <div class="">
            
            <form class="form-horizontal" action="{{ route('purchaseReturn.save') }}" method="POST" enctype="multipart/form-data" id="newMenu" name="newMenu">
            {{ csrf_field() }}
            
            @if( count($errors) > 0 )
                
            <div style="display:inline-block;width: auto;" class="alert alert-danger">{{ $errors->first() }}</div>
            
        @endif
            <div class="modal-body">
               
            <div class="col-md-11 m-b-20 text-right">    
                 <button type="submit" class="btn btn-info waves-effect">Save</button> 
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                       <div class="col-6">
                            <div class="form-group row {{ $errors->has('purchase_return_serial') ? ' has-danger' : '' }}">
                                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label" style="text-align: right;">SL No</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-danger" value="{{$purchase_return_serial}}" name="purchase_return_serial" required readonly>
                                    @if ($errors->has('purchase_return_serial'))
                                    @foreach($errors->get('purchase_return_serial') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group row {{ $errors->has('purchase_return_date') ? ' has-danger' : '' }}">
                                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label" style="text-align: right;">Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-danger add_datepicker" name="purchase_return_date" required readonly>
                                    @if ($errors->has('purchase_return_date'))
                                    @foreach($errors->get('purchase_return_date') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-6">
                            <div class="form-group row {{ $errors->has('supplier_id') ? ' has-danger' : '' }}">
                                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label" style="text-align: right;">Supplier</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-danger chosen-select supplier" name="supplier_id" required="">
                                        <option value=" ">Select Supplier</option>
                                        <?php
                                            foreach ($vendors as $vendor) {
                                        ?>
                                        <option value="{{$vendor->id}}">{{$vendor->vendorName}}</option>
                                        <?php } ?>
                                    </select>
                                    @if ($errors->has('supplier_id'))
                                    @foreach($errors->get('supplier_id') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                       <div class="col-md-12">
                            <div class="form-group row {{ $errors->has('remarks') ? ' has-danger' : '' }}">
                                <label for="inputHorizontalDnger" class="col-sm-2 col-form-label" style="text-align: right;margin-left: -33px">Rmarks</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control form-control-danger" name="remarks" style="min-height: 100px;width: 104%"></textarea>
                                    @if ($errors->has('remarks'))
                                    @foreach($errors->get('remarks') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped gridTable" >
                                <thead>
                                    <tr>
                                        <th width="40%">Item</th>
                                        <th width="16%">Quantity</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr>
                                        <td>
                                            <select class="form-control form-control-danger chosen-select" name="product_id[]" required="">
                                                <option value=" ">Select Item</option>
                                                <?php
                                                    foreach ($products as $product) {
                                                ?>
                                                <option value="{{$product->id}}">{{$product->name}} ({{$product->deal_code}})</option>
                                                <?php } ?>
                                        </select>
                                        </td>
                                        <td><input class="qty qty_1" type="number" name="qty[]" oninput="totalAmount('1')" required></td>
                                        <td><input class="rate_1" type="number" name="rate[]" oninput="totalAmount('1')" required></td>
                                        <td><input class="amount amount_1" type="number" name="amount[]" required readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" class="row_count" value="1"> 
                            <p align="right"> <span class="btn btn-success add_item"><i class="fa fa-plus"></i> Add Item</span></p>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                             <label for="inputHorizontalDnger" class="col-sm-3 col-form-label" style="text-align: right;">Total Qty</label>
                            <input class="total_qty" type="text" name="total_qty" readonly>
                        </div>

                        <div class="col-md-6">
                             <label for="inputHorizontalDnger" class="col-sm-3 col-form-label" style="text-align: right;">Total Amount</label>
                            <input class="total_amount" type="text" name="total_amount" readonly>
                        </div>
                    </div>

                </div>
            </div>
     
            </div>                
            </form>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
                
            </div>
        </div>
    </div>
</div>

<div id="itemList" style="display:none">
    <div class="input select">
    <select>
        <option value=" ">Select Item</option>
        <?php
            foreach ($products as $product) {
        ?>
        <option value="{{$product->id}}">{{$product->name}} ({{$product->deal_code}})</option>
        <?php } ?>
    </select>
    </div>
</div>

@endsection

@section('custom-js')

<script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>


<script type="text/javascript">
     $(document).ready(function() { 
        $("form").submit(function(e){
            var supplier = $(".supplier").val();
            var supplier = $.trim(supplier);
            if(supplier == ''){
                alert('Please Select Supplier !');
                e.preventDefault();
            }

            });            
    });

        
</script>

<script type="text/javascript">
    $(".add_item").click(function () {
        var row_count = $('.row_count').val();
        var total = parseInt(row_count) + 1; 
        $(".gridTable tbody").append('<tr id="itemRow_' + total + '">' +
            '<td>'+
            '<select name="product_id[]" class="form-control chosen-select itemList_'+total+'">'+
            '</select>'+
            '</td>'+
            '<td><input class="qty qty_'+total+'" type="number" name="qty[]" required oninput="totalAmount('+total+')"></td>'+
            '<td><input class="rate_'+total+'" type="number" name="rate[]" required oninput="totalAmount('+total+')"></td>'+
            '<td><span class="item_remove"><i class="fa fa-times" onclick="itemRemove(' + total + ')"></i>'+
            '<input class="amount amount_'+total+'" type="number" name="amount[]" required readonly></span></td>'+
            '</tr>');
        $('.row_count').val(total);
        var itemList = $("#itemList div select").html();
        $('.itemList_'+total).html(itemList);
         $('.chosen-select').chosen();
        $('.chosen-select').trigger("chosen:updated");
    });

    function itemRemove(i) {
            $("#itemRow_" + i).remove();
        }

    function totalAmount(i){
         var qty = $(".qty_" + i).val();
        var rate = $(".rate_" + i).val();
        var sum_total = parseFloat(qty) *parseFloat(rate);
        $(".amount_" + i).val(sum_total.toFixed(2));

        row_sum(); 
        netAmount() 
    }


    function row_sum() {
        var total_qty = 0;
        var total_amount = 0;
        $(".qty").each(function () {
            var stvalTotal = parseFloat($(this).val());
            //            console.log(stval);
            total_qty += isNaN(stvalTotal) ? 0 : stvalTotal;
        });

        $(".amount").each(function () {
            var stvalAmount = parseFloat($(this).val());
            //            console.log(stval);
            total_amount += isNaN(stvalAmount) ? 0 : stvalAmount;
        });

        $('.total_qty').val(total_qty.toFixed(2));
        $('.total_amount').val(total_amount.toFixed(2));

    }

      
</script>

@endsection