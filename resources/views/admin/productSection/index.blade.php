@extends('admin.layouts.master')

@section('content')
@php
    use App\DeliveryZone;
    use App\Model\Area;
@endphp
    <div class="table-responsive">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th width="20px">SL</th>
                    <th>Section Name</th>
                    <th width="180px">Content Section</th>
                    <th width="20px">Order</th>
                    <th width="20px">Status</th>
                    <th width="20px">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php $i= 1; ?>
                @foreach($product_section_list as $product_section)                         
                <tr class="row_{{$product_section->id}}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $product_section->name }}</td>
                    <td>{{ @$product_section->content_section }}</td>
                    <td class="text-center">{{ $product_section->order_by }}</td>
                    <td>
                        <?php echo \App\Link::status($product_section->id,$product_section->status)?>
                    </td>
                    <td class="text-nowrap">
                       <?php echo \App\Link::action($product_section->id)?>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('custom-js')

    <script>
        $(document).ready(function() {
            var updateThis ;
            
            //ajax delete code
            $('.datatable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                section_id = $(this).parent().data('id');
                var shippingCharges = this;
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                }, function(isConfirm){   
                    if (isConfirm) {     
                        $.ajax({
                            type: "POST",
                            
                            url: "{{ route('productsection.delete',0) }}",
                            data: {
                                section_id:section_id
                            },
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: " Product Section Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                
                                $('.row_'+section_id).remove();
                            },
                            error: function(response) {
                                error = "Failed.";
                                swal({
                                    title: "<small class='text-danger'>Error!</small>", 
                                    type: "error",
                                    text: error,
                                    timer: 1000,
                                    html: true,
                                });
                            }
                        });   
                    } else { 
                        swal({
                            title: "Cancelled", 
                            type: "error",
                            text: "Shipping product_section is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(section_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('productsection.status', 0) }}",
                    data: "section_id=" + section_id,
                    
                    success: function(response) {
                        swal({
                            title: "<small class='text-success'>Success!</small>", 
                            type: "success",
                            text: "Status successfully updated!",
                            timer: 1000,
                            html: true,
                        });
                    },
                    error: function(response) {
                        error = "Failed.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 2000,
                            html: true,
                        });
                    }
                });
            }
    </script>
@endsection