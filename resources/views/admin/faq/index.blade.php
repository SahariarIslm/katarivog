@extends('admin.layouts.master')

@section('content')

    <div class="table-responsive">
        <table id="faqsTable" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th width="20px">SL</th>
                    <th width="350px">Question</th>
                    <th>Answer</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php
                    $i = 0;
                @endphp
                @foreach($faqs as $faq)                         
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $faq->title }}</td>
                    <td>
                        @php
                            echo str_limit($faq->description,'100');
                        @endphp
                    </td>
                   
                    <td>
                        <?php echo \App\Link::status($faq->id,$faq->status)?>
                    </td>
                    <td class="text-nowrap">
                    <?php echo \App\Link::action($faq->id)?>
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

            //ajax delete code
            $('#faqsTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                faq_id = $(this).parent().data('id');
                var faq = this;
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
                            type: "DELETE",
                            url: "{{ route('faqs.index') }}" + "/" + faq_id,
                            dataType: "JSON",
                            data: {
                                id:faq_id
                            },
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "faq deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(faq).parents('tr'))
                                    .remove()
                                    .draw();
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
                            text: "Your faq is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(faq_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('faqs.changeStatus', 0) }}",
                    data: "faq_id=" + faq_id,
                    cache:false,
                    contentType: false,
                    processData: false,
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