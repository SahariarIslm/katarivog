 <script type='text/javascript'>
    $(document).ready(function() {
        //javascript for newsletter
            $(".subscribeButton").click(function(e){
                e.preventDefault();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            }); 

            var subscriberEmail = $('.subscriberEmail').val();

           $.ajax({
                type: "POST",
                url : "{{ route('subscriberEmailSave') }}",
                data :  {
                            subscriberEmail:subscriberEmail
                        },
                success: function(response) {
                    swal.fire({
                        title: "<p class='text-success' style='line-height:30px'>Success ! You are subscribed</p>", 
                        type: "success",
                        timer: 4000
                    });
                    $("form[name='newsletterForm']").trigger("reset");
                },
                error: function(response) {
                    errorMessage = Object.entries(response.responseJSON.errors);
                    swal.fire({
                        title: "<p class='text-danger' style='line-height:30px'>Error !  "+errorMessage[0][1]+"</p>", 
                        type: "error",
                        timer: 4000
                    });
                }

            });    
        }); 

    });
                
</script>